<?php

namespace YVolkan\ApiProvider;

use Illuminate\Support\ServiceProvider;

class ApiProviderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ApiProvider::class, function () {
            return new ApiProvider();
        });

        $this->app->alias(ApiProvider::class, 'apiProvider');
    }
}