<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;

class AdminAuthenticate extends Authenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        $response = parent::handle($request, $next, 'admin');

        // Authenticated admin pages must never be cached (by the browser
        // or an intermediary) — otherwise dashboard/enquiry data can
        // resurface via the back button on a shared computer after logout.
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');

        return $response;
    }

    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('admin.login');
    }
}
