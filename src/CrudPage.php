<?php

namespace Ycs77\LaravelCrudPage;

use Illuminate\Foundation\Application;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use Ycs77\LaravelCrudPage\Http\Controllers\Concerns\Routes;

class CrudPage
{
    use Macroable;
    use Routes;

    /**
     * Application instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Config instance.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * CRUD resources routes.
     *
     * @var array
     */
    protected $crudRoutes = [];

    /**
     * Create new CrudPage instance.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->config = $app['config'];
    }

    /**
     * Get resource slug.
     *
     * @param  string  $slug
     * @return string
     */
    public function getPluralSlug(string $slug)
    {
        return Str::plural($slug);
    }

    /**
     * Generate routes.
     *
     * @param  string  $slug
     * @return void
     */
    public function routes(string $slug)
    {
        $config = $this->getCrudConfig($slug);
        $actions = $config['actions'];
        $this->crudRoutes[$slug] = [];

        foreach ($actions as $action => $displayed) {
            $this->crudRoutes[$slug] = array_merge(
                $this->crudRoutes[$slug],
                $this->callRegisterRoutes(
                    $action,
                    $displayed,
                    compact('slug', 'config')
                )
            );
        }
    }

    /**
     * Call register routes.
     *
     * @param  string   $action
     * @param  boolean  $displayed
     * @param  array    $data
     * @return array
     */
    protected function callRegisterRoutes(string $action, bool $displayed, array $data)
    {
        extract($data);

        $controller_class = $config['controller'];
        $action = ucfirst($action);
        $action_class = "register{$action}Route";

        if (!$displayed) {
            return [];
        }

        $call_class = app($controller_class);
        if (!method_exists($call_class, $action_class)) {
            $call_class = $this;
        }

        return call_user_func(
            [$call_class, $action_class],
            $slug,
            $controller_class
        );
    }

    /**
     * Get crud resource config.
     *
     * @param  string  $slug
     * @param  string|null  $key
     * @return array
     */
    public function getCrudConfig(string $slug, string $key = null)
    {
        $default = $this->config->get('crud-page.resources.default', []);
        $custom = $this->config->get("crud-page.resources.$slug", []);
        $config = array_merge($default, $custom);
        return $key ? $config[$key] : $config;
    }

    /**
     * Get CRUD resource routes.
     *
     * @return array
     */
    public function getCrudRoutes()
    {
        return $this->crudRoutes;
    }

    /**
     * Get CRUD resource route.
     *
     * @param  string       $slug
     * @param  string       $action
     * @param  string|null  $action
     * @return string|null
     */
    public function getCrudRoute($slug, $action, $default = null)
    {
        return $this->crudRoutes[$slug][$action] ?? $default;
    }

    /**
     * Has CRUD resource route.
     *
     * @param  string  $slug
     * @param  string  $action
     * @return bool
     */
    public function hasCrudRoute($slug, $action)
    {
        return isset($this->crudRoutes[$slug][$action]);
    }
}
