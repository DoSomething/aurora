<?php

namespace Aurora\Providers;

use Aurora\Services\Fastly;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Fastly::class, function ($app) {
            return new Fastly(config('services.fastly'));
        });
    }
}
