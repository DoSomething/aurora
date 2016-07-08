<?php

namespace Aurora\Providers;

use DoSomething\Northstar\Northstar;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The Northstar API client.
     * @var Northstar
     */
    private $northstar;

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Aurora\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        $northstar = app('northstar');

        $router->bind('users', function ($id) use ($northstar) {
            $user = $northstar->getUser('_id', $id);

            if (! $user) {
                throw new NotFoundHttpException;
            }

            return $user;
        });

        $router->bind('clients', function ($id) use ($northstar) {
            $key = $northstar->getClient($id);

            if (! $key) {
                throw new NotFoundHttpException;
            }

            return $key;
        });

        $router->model('aurora-users', '\Aurora\Models\AuroraUser');

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
