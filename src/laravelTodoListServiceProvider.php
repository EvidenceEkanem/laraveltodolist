<?php

namespace evidenceekanem\laravelTodoList;

use Illuminate\Support\ServiceProvider;

class laravelTodoListServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'laraveltodolist');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

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
        // Register the service the package provides.
        $this->app->singleton('laraveltodolist', function ($app) {
            return new laravelTodoList;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laraveltodolist'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        
        // Publishing the views.
        $this->publishes([
            __DIR__.'/resources/views' => base_path('vendor/laravelTodoList'),
        ], 'views');

        // Publishing assets.
        $this->publishes([
            __DIR__.'/assets' => public_path('vendor/laravelTodoList'),
        ], 'public');

        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations')
        ], 'migrations');
    }
}
