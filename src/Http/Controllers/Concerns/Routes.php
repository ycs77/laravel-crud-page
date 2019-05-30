<?php

namespace Ycs77\LaravelCrudPage\Http\Controllers\Concerns;

use Illuminate\Support\Facades\Route;

trait Routes
{
    /**
     * Register index route.
     *
     * @param  string  $slug
     * @param  string  $controller
     * @return array
     */
    public function registerIndexRoute(string $slug, string $controller)
    {
        $slug = $this->getPluralSlug($slug);
        Route::get("$slug", "$controller@index")->name("$slug.index");

        return [
            'index' => "$slug.index",
        ];
    }

    /**
     * Register create route.
     *
     * @param  string  $slug
     * @param  string  $controller
     * @return array
     */
    public function registerCreateRoute(string $slug, string $controller)
    {
        $slug = $this->getPluralSlug($slug);
        Route::get("$slug/create", "$controller@create")->name("$slug.create");
        Route::post("$slug", "$controller@store")->name("$slug.store");

        return [
            'create' => "$slug.create",
            'store' => "$slug.store",
        ];
    }

    /**
     * Register show route.
     *
     * @param  string  $slug
     * @param  string  $controller
     * @return array
     */
    public function registerShowRoute(string $slug, string $controller)
    {
        $slug = $this->getPluralSlug($slug);
        Route::get("$slug/{id}", "$controller@show")->name("$slug.show");

        return [
            'show' => "$slug.show",
        ];
    }

    /**
     * Register edit route.
     *
     * @param  string  $slug
     * @param  string  $controller
     * @return array
     */
    public function registerEditRoute(string $slug, string $controller)
    {
        $slug = $this->getPluralSlug($slug);
        Route::get("$slug/{id}/edit", "$controller@edit")->name("$slug.edit");
        Route::put("$slug/{id}", "$controller@update")->name("$slug.update");

        return [
            'edit' => "$slug.edit",
            'update' => "$slug.update",
        ];
    }

    /**
     * Register delete route.
     *
     * @param  string  $slug
     * @param  string  $controller
     * @return array
     */
    public function registerDeleteRoute(string $slug, string $controller)
    {
        $slug = $this->getPluralSlug($slug);
        Route::delete("$slug/{id}", "$controller@destroy")->name("$slug.destroy");

        return [
            'destroy' => "$slug.destroy",
        ];
    }
}
