# Laravel CRUD Pages

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

Fast generate CRUD pages, controllers of the Laravel.

> This package is for `users` to use, **NOT** `administrator`.

* The form builder uses packages [Laravel form builder](https://github.com/kristijanhusak/laravel-form-builder) and [Laravel form field type](https://github.com/ycs77/laravel-form-field-type), config use [Laravel form builder BS4](https://github.com/ycs77/laravel-form-builder-bs4).
* The table builder uses [kabbouchi/laravel-table-view](https://github.com/kabbouchi/laravel-table-view)
* This package the icon uses [Fontawesome 5](https://fontawesome.com/)'s icon, requires manual installation.

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

Add resources routes (resource `post` is example):

*config/crud-page.php*
```php
CrudPage::routes('post');
```

### Controller

Create controller:

```
php artisan make:crud:controller PostController
```

Created a new CRUD controller:

```php
class PostController extends CrudController
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
            'title' => [
                'type' => 'text',
                'rules' => 'required|max:50',
            ],
            'content' => [
                'type' => 'textarea',
                'rules' => 'required',
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
            'Title' => 'title',
        ];
    }
}

```

### View

If you want override view, can create view to views folder `posts/index`. (`posts` is resource name, `index` is action).

## LICENSE

[MIT LICENSE](LICENSE.md)

[ico-version]: https://img.shields.io/packagist/v/ycs77/laravel-crud-page.svg?style=flat
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat
[ico-circleci]: https://img.shields.io/circleci/project/github/ycs77/laravel-crud-page/master.svg?style=flat
[ico-downloads]: https://img.shields.io/packagist/dt/ycs77/laravel-crud-page.svg?style=flat

[link-packagist]: https://packagist.org/packages/ycs77/laravel-crud-page
[link-circleci]: https://circleci.com/gh/ycs77/laravel-crud-page
[link-downloads]: https://packagist.org/packages/ycs77/laravel-crud-page
