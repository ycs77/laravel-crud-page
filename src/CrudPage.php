<?php

namespace Ycs77\LaravelCrudPage;

class CrudPage
{
    use Macroable;

    /**
     * Application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Create new CrudPage instance.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct($app)
    {
        //
    }
}
