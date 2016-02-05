<?php

namespace Aurora\Providers;

use Aurora\Services\Northstar;
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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('\Aurora\Services\Northstar', function () {
            return new Northstar(config('services.northstar'));
        });
    }
}
