<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Resources Config
    |--------------------------------------------------------------------------
    |
    | The resources config, used to generate crud pages, controllers.
    |
    */

    'resources' => [

        'default' => [
            'controller' => '\Ycs77\LaravelCrudPage\Http\Controllers\CrudController',
            'file_store' => 'images',
            'views_prefix' => '',
            'actions' => [
                'index' => true,
                'create' => true,
                'show' => true,
                'edit' => true,
                'delete' => true,
            ],
        ],

        // 'user' => [
        //     'model' => '\App\User',
        //     'controller' => '\App\Http\Controllers\UserController',
        //     'file_store' => 'users',
        //     'view_prefix' => null,
        //     'actions' => [
        //         'index' => true,
        //         'create' => true,
        //         'show' => true,
        //         'edit' => true,
        //         'delete' => true,
        //     ],
        // ],

    ],

];
