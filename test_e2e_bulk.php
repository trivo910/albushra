<?php
// E2E: admin bulk-delete via AJAX
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';

use App\Models\Package;
use App\Models\Review;
use App\Models\Admin;

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

echo "=== E2E: admin bulk delete via AJAX ===\n\n";

$admin = Admin::firstOrCreate(
    ['email' => 'admin@albushra.test'],
    ['name' => 'Al Bushra Admin', 'password' => bcrypt('password')]
);
auth('admin')->login($admin);

// Warm up session
$indexReq  = Illuminate\Http\Request::create('/admin/reviews', 'GET');
$kernel->handle($indexReq);

$p = Package::find(2);
$r1 = Review::create(['package_id' => $p->id, 'reviewer_name' => 'Bulk A', 'reviewer_email' => 'a@a.com', 'rating' => 5, 'title' => 'A', 'comment' => 'A', 'status' => 'approved']);
$r2 = Review::create(['package_id' => $p->id, 'reviewer_name' => 'Bulk B', 'reviewer_email' => 'b@b.com', 'rating' => 3, 'title' => 'B', 'comment' => 'B', 'status' => 'approved']);
$p->refresh();
echo "Inserted reviews id={$r1->id}, id={$r2->id}. Package: rating={$p->rating} count={$p->rating_count}\n";

// Simulate the bulk form submission with X-Requested-With + Accept: application/json
$req = Illuminate\Http\Request::create(
    '/admin/reviews/bulk-destroy',
    'POST',
    ['ids' => [$r1->id, $r2->id]],
    [],
    [],
    [
        'HTTP_X_CSRF_TOKEN' => csrf_token(),
        'HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest',
        'HTTP_ACCEPT' => 'application/json',
    ]
);
$resp = $kernel->handle($req);

echo "Status: {$resp->getStatusCode()}\n";
echo "Body  : " . substr($resp->getContent(), 0, 200) . "\n";

if ($resp->getStatusCode() === 200) {
    $body = json_decode($resp->getContent(), true);
    if (($body['status'] ?? null) === 'ok' && ($body['deleted'] ?? 0) === 2) {
        echo "✅ Bulk delete returned proper JSON with deleted=2\n";
    } else {
        echo "❌ Unexpected JSON: " . json_encode($body) . "\n";
        exit(1);
    }
} else {
    echo "❌ Expected HTTP 200, got {$resp->getStatusCode()}\n";
    exit(1);
}

$p->refresh();
echo "Package AFTER bulk: rating={$p->rating} count={$p->rating_count}\n";

// Final cleanup
Review::withTrashed()->whereIn('id', [$r1->id, $r2->id])->forceDelete();
echo "Cleaned up.\n=== ALL E2E CHECKS PASSED ===\n";