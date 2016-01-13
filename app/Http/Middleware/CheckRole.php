<?php

namespace Aurora\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class CheckRole
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // If user is a guest (e.g. no role), or is missing the provided role... get out!
        if ($this->auth->guest() || !$this->auth->user()->hasRole($role)) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->back()->with('flash_message', [
                    'class' => 'messages -error',
                    'text' => 'Unauthorized.'
                ]);
            }
        }

        return $next($request);
    }
}
