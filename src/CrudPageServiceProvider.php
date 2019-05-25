<?php

namespace Ycs77\LaravelCrudPage;

use Illuminate\Support\ServiceProvider;

class CrudPageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('laravel-crud-page', function ($app) {
            return new CrudPage($app);
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/crud-page.php', 'crud-page');
    }
}
