<?php

namespace Aurora\Http\Middleware;

use Closure;
use League\Uri\Http;
use function League\Uri\parse;
use Illuminate\Support\Facades\Log;

class ForceHttps
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // If running in a non-local environment, redirect all traffic to HTTPS
        // and the correct canonical URL, e.g. never '*.herokuapp.com'!
        if (config('app.env') !== 'local') {
            Log::debug($request);

            $canonicalHost = parse(config('app.url'))['host'];
            $hasIncorrectHost = $request->header('Host') !== $canonicalHost;

            if ($hasIncorrectHost || ! $request->secure()) {
                $parsedUrl = parse($request->url());
                $parsedUrl['scheme'] = 'https';
                $parsedUrl['host'] = $canonicalHost;

                $secureUrl = Http::createFromComponents($parsedUrl);

                return redirect()->secure((string) $secureUrl);
            }
        }

        return $next($request);
    }
}
