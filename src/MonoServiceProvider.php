<?php

namespace Myckhel\Mono;

use Illuminate\Support\ServiceProvider;

class MonoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->mergeConfigFrom(__DIR__.'/../config/mono.php', 'mono');

        // Register the service the package provides.
        $this->app->singleton('mono', fn ($app) =>
            new Mono
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    function provides(){
        return ['mono'];
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
