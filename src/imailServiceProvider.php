<?php

namespace saeedphr\imail;

use Illuminate\Support\ServiceProvider;

class imailServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'saeedphr');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'saeedphr');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->app->make('saeedphr\imail\ImailController');
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        require __DIR__.'/../vendor/autoload.php';
        $this->mergeConfigFrom(__DIR__.'/../config/imail.php', 'imail');
        // Register the service the package provides.
        $this->app->singleton('imail', function ($app) {
            return new imail;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['imail'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/imail.php' => config_path('imail.php'),
        ], 'imail.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/saeedphr'),
        ], 'imail.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/saeedphr'),
        ], 'imail.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/saeedphr'),
        ], 'imail.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
