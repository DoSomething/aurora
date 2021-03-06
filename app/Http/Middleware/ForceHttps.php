<?php

namespace Aurora\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use League\Uri\Http;
use League\Uri\UriString;

class ForceHttps
{
    /**
     * Handle an incoming request.
     * This middleware needs to run after the TrustProxies middleware.
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
            $canonicalHost = UriString::parse(config('app.url'))['host'];

            $hasIncorrectHost = $request->header('Host') !== $canonicalHost;

            Log::debug('Middelware/ForceHttps@handle Request:', [
                'Canonical Host' => $canonicalHost,
                'Request Host' => $request->header('Host'),
                'Incorrect Request Host' => $hasIncorrectHost,
                'Secure Request' => $request->secure(),
            ]);

            if ($hasIncorrectHost || !$request->secure()) {
                $parsedUrl = UriString::parse($request->url());
                $parsedUrl['scheme'] = 'https';
                $parsedUrl['host'] = $canonicalHost;

                $secureUrl = Http::createFromComponents($parsedUrl);

                Log::debug('Middelware/ForceHttps@handle Redirect:', [
                    'Parsed Request URL' => $parsedUrl,
                    'Secured URL' => (string) $secureUrl,
                ]);

                return redirect()->secure((string) $secureUrl);
            }
        }

        return $next($request);
    }
}
