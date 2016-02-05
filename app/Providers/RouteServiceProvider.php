<?php

namespace Aurora\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RouteServiceProvider extends ServiceProvider
{
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
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        $router->bind('users', function ($id) {
            $user = app('\Aurora\Services\Northstar')->getUser('_id', $id);

            if (! $user) {
                throw new NotFoundHttpException;
            }

            return $user;
        });

        $router->bind('keys', function ($id) {
            $key = app('\Aurora\Services\Northstar')->getApiKey($id);

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
