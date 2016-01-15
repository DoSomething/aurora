<?php

namespace Aurora\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app('auth')->extend('northstar', function () {
            return new \Aurora\Auth\NorthstarUserProvider($this->app['hash'], config('auth.model'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
