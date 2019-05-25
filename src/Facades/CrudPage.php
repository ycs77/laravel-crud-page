<?php

namespace Ycs77\LaravelCrudPage\Facades;

use Illuminate\Support\Facades\Facade;

/**
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
        return 'laravel-crud-page';
    }
}
