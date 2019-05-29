<?php

namespace Ycs77\LaravelCrudPage\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void routes(string $slug)
 * @method static array getCrudConfig(string $slug, string $key)
 * @method static array getCrudRoutes()
 * @method static string|null getCrudRoute(string $slug, string $action)
 * @method static bool hasCrudRoute(string $slug, string $action)
 * 
 * @see \Ycs77\LaravelCrudPage\CrudPage
 */
class CrudPage extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'crud-page';
    }
}
