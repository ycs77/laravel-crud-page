<?php

namespace Ycs77\LaravelCrudPage;

use Illuminate\Support\ServiceProvider;
use Ycs77\LaravelCrudPage\Console\CrudControllerMakeCommand;

class CrudPageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands(CrudControllerMakeCommand::class);

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'crudpage');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'crud-page');
        $this->loadViewsFrom(__DIR__ . '/../resources/views_table', 'tableView');

        $this->publishes([
            __DIR__ . '/../config/crud-page.php' => config_path('crud-page.php'),
            __DIR__ . '/../config/tableView.php' => config_path('tableView.php'),
            __DIR__ . '/../resources/views_table' => resource_path('views/vendor/tableView'),
        ], 'laravel-crud-page');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('crud-page', function ($app) {
            return new CrudPage($app);
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/crud-page.php', 'crud-page');
        $this->mergeConfigFrom(__DIR__ . '/../config/tableView.php', 'tableView');
    }
}
