<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanonicalUrl
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethodSafe()) {
            return $next($request);
        }

        $host = preg_replace('/^www\./i', '', $request->getHost());
        $path = preg_replace('#^/public(?=/|$)#i', '', $request->getPathInfo());
        $path = $path === '' ? '/' : $path;

        if ($path !== '/') {
            $path = rtrim($path, '/');
        }

        if ($host === $request->getHost() && $path === $request->getPathInfo()) {
            return $next($request);
        }

        $url = $request->getScheme().'://'.$host;
        $defaultPort = $request->isSecure() ? 443 : 80;

        if ($request->getPort() !== $defaultPort) {
            $url .= ':'.$request->getPort();
        }

        $url .= $path;

        if ($request->getQueryString()) {
            $url .= '?'.$request->getQueryString();
        }

        return redirect()->to($url, 301);
    }
}