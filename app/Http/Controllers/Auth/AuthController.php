<?php

namespace Aurora\Http\Controllers\Auth;

use Aurora\Http\Controllers\Controller;
use DoSomething\Gateway\Northstar;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/users';

    /**
     * Where to redirect users after logout.
     *
     * @var string
     */
    protected $redirectAfterLogout = '/';

    /**
     * The Northstar API client.
     *
     * @var Northstar
     */
    protected $northstar;

    /**
     * Create a new authentication controller instance.
     *
     * @param Northstar $northstar
     */
    public function __construct(Northstar $northstar)
    {
        $this->northstar = $northstar;

        $this->middleware('guest')->except('getLogout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogin(
        ServerRequestInterface $request,
        ResponseInterface $response
    ) {
        return $this->northstar->authorize(
            $request,
            $response,
            $this->redirectTo,
        );
    }

    /**
     * Handle a logout request to the application.
     *
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function getLogout(ResponseInterface $response)
    {
        return $this->northstar->logout($response, $this->redirectAfterLogout);
    }
}
