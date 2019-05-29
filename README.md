# Laravel CRUD Pages

Fast generate CRUD pages, controllers of the Laravel.

> This package is for users to use, not administrator.

* The form builder uses packages [Laravel form builder](https://github.com/kristijanhusak/laravel-form-builder) and [Laravel form field type](https://github.com/ycs77/laravel-form-field-type), config use [Laravel form builder BS4](https://github.com/ycs77/laravel-form-builder-bs4).
* The table builder uses [kabbouchi/laravel-table-view](https://github.com/kabbouchi/laravel-table-view)

## Installation

Via Composer:

```
composer require ycs77/laravel-crud-page
```

Publish config (**Required**):

```
php artisan vendor:publish --tag=laravel-crud-page
php artisan vendor:publish --tag=laravel-form-builder-bs4
php artisan vendor:publish --tag=laravel-form-field-type-config
```

## Usage

### Config

Add your resource to config:

*config/crud-page.php*
```php
'resources' => [
    // ...

    'post' => [
        'model' => '\App\Post',
        'controller' => '\App\Http\Controllers\PostController',
        'file_store' => 'posts',
        'view_name' => null,
        'actions' => [
            'index' => true,
            'create' => true,
            'show' => true,
            'edit' => true,
            'delete' => true,
        ],
    ],
],
```

### Routes

Add resources routes (resource `user` is example):

*config/crud-page.php*
```php
CrudPage::routes('post');
```

### Controller

Create controller:

```
php artisan make:crud:controller UserController
```

Created a new CRUD controller:

```php
class UserController extends CrudController
{
    /**
     * Get form fields.
     * 
     * @see https://github.com/ycs77/laravel-form-field-type
     * 
     * @return array
     */
    protected function formFields()
    {
        return [
            'name' => [
                'rules' => 'required|max:50',
            ],
            'submit',
        ];
    }

    /**
     * Get table fields.
     *
     * @see https://github.com/KABBOUCHI/laravel-table-view#usage
     * 
     * @return array
     */
    protected function getTableFields()
    {
        return [
            'Name' => 'name',
        ];
    }
}

```

### View

If you want override view, can create view to views folder `users/index`. (`users` is resource name, `index` is action).
