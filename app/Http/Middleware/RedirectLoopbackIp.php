<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectLoopbackIp
{
    /**
     * YouTube refuses to play an embed when the parent page is opened
     * by an IP address such as 127.0.0.1. Locally, send those visits to localhost.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! app()->environment('local') || $request->getHost() !== '127.0.0.1') {
            return $next($request);
        }

        $port = $request->getPort();
        $target = 'http://localhost'.(in_array($port, [80, 443], true) ? '' : ':'.$port).$request->getRequestUri();

        return redirect()->away($target, $request->isMethod('GET') ? 302 : 307);
    }
}
