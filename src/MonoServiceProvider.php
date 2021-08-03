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
