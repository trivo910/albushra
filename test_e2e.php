<?php
// End-to-end test of the admin review delete flow exactly as the browser
// executes it (axios DELETE with X-CSRF-TOKEN header).
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';

use App\Models\Package;
use App\Models\Review;
use App\Models\Admin;

// Boot the HTTP kernel so the request lifecycle (middleware, auth, route resolution) works
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

echo "=== E2E: admin single-review delete (mirrors the new data-delete-url button) ===\n\n";

// Find or create the admin user (the route is behind the admin.auth middleware,
// which uses the 'admin' guard backed by the Admin model)
$admin = Admin::firstOrCreate(
    ['email' => 'admin@albushra.test'],
    ['name' => 'Al Bushra Admin', 'password' => bcrypt('password')]
);
echo "✓ Admin id={$admin->id} ({$admin->email})\n";

// Log the admin in on the 'admin' guard (the one the route uses)
auth('admin')->login($admin);
echo "✓ Authenticated on 'admin' guard\n";

// Warm up the session + CSRF token by hitting the reviews index once.
// This is the same flow a browser would follow: load the page, get a session,
// then submit the DELETE with the matching token.
$indexReq  = Illuminate\Http\Request::create('/admin/reviews', 'GET');
$indexResp = $kernel->handle($indexReq);
echo "✓ Index page status: {$indexResp->getStatusCode()}\n";
$kernel->terminate($indexReq, $indexResp);

// The session is now bound to this PHP process; csrf_token() will return a
// token that ValidateCsrfToken will accept for the next request in the same
// session lifecycle (Laravel re-generates per-session, not per-request).
$csrf = csrf_token();
echo "✓ Session CSRF token: " . substr($csrf, 0, 12) . "...\n";

// Make sure we have a package with a fresh approved review to delete
$p = Package::find(2);
if (!$p) { $p = Package::first(); }
echo "Using package id={$p->id} ({$p->title})\n";

$review = Review::create([
    'package_id' => $p->id,
    'reviewer_name' => 'E2E Delete Test',
    'reviewer_email' => 'e2e@delete.test',
    'rating' => 5,
    'title' => 'E2E test',
    'comment' => 'This review will be deleted by the simulated click.',
    'status' => 'approved',
]);
echo "Inserted review id={$review->id} (rating={$review->rating})\n";

$p->refresh();
echo "Package BEFORE delete: rating={$p->rating} count={$p->rating_count}\n";

// Simulate the exact request the JS will make: axios DELETE with X-CSRF-TOKEN,
// Accept: application/json (so Laravel returns 200 JSON, not a redirect).
$csrf = csrf_token();
$url  = "/admin/reviews/{$review->id}";

$request  = Illuminate\Http\Request::create($url, 'DELETE', [], [], [], [
    'HTTP_X_CSRF_TOKEN'   => $csrf,
    'HTTP_X_REQUESTED_WITH'=> 'XMLHttpRequest',
    'HTTP_ACCEPT'          => 'application/json',
]);
$response = $kernel->handle($request);

echo "Response status: " . $response->getStatusCode() . "\n";
echo "Response body  : " . substr($response->getContent(), 0, 200) . "\n";

// Decode JSON and check success
$body = json_decode($response->getContent(), true);
if ($response->getStatusCode() === 200) {
    echo "✅ HTTP 200 — delete succeeded\n";
} else {
    echo "❌ HTTP {$response->getStatusCode()} — delete failed\n";
    echo $response->getContent() . "\n";
    exit(1);
}

// Verify in DB
$trashed = Review::withTrashed()->find($review->id);
if ($trashed && $trashed->trashed()) {
    echo "✅ Review id={$review->id} is soft-deleted (deleted_at={$trashed->deleted_at})\n";
} else {
    echo "❌ Review id={$review->id} is NOT soft-deleted\n";
    exit(1);
}

$p->refresh();
echo "Package AFTER delete: rating={$p->rating} count={$p->rating_count}\n";

// Final cleanup: remove the soft-deleted row so the workspace stays tidy
$trashed->forceDelete();
echo "Cleaned up soft-deleted test row.\n";
echo "\n=== ALL E2E CHECKS PASSED ===\n";