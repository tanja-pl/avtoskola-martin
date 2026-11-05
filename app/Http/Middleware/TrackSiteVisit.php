<?php

namespace App\Http\Middleware;

use App\Services\SiteVisitRecorder;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackSiteVisit
{
    public function __construct(private SiteVisitRecorder $recorder) {}

    /**
     * Count the visit after the response is ready so the page is not held for the write.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($this->shouldTrack($request, $response)) {
            defer(fn () => $this->recorder->record($request));
        }

        return $response;
    }

    private function shouldTrack(Request $request, Response $response): bool
    {
        if (! $request->isMethod('GET') || ! $request->hasSession()) {
            return false;
        }

        if (auth()->check() || $request->is('admin', 'admin/*', 'up')) {
            return false;
        }

        if ($request->ajax() || $request->expectsJson() || $request->prefetch() || $request->isPrecognitive()) {
            return false;
        }

        if ($this->isRobot($request) || ! $response->isSuccessful()) {
            return false;
        }

        return str_contains((string) $response->headers->get('Content-Type'), 'text/html');
    }

    private function isRobot(Request $request): bool
    {
        $agent = (string) $request->userAgent();

        if ($agent === '') {
            return false;
        }

        return preg_match('/bot|crawl|spider|slurp|facebookexternalhit|lighthouse|pingdom|wget|curl\//i', $agent) === 1;
    }
}
