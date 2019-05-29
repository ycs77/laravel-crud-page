<?php

namespace Ycs77\LaravelCrudPage\Actions;

class Actions
{
    /**
     * Actions instances.
     *
     * @var array
     */
    protected $instances = [];

    /**
     * Create new Actions instance.
     *
     * @param array $actions
     */
    public function __construct(array $actions)
    {
        foreach ($actions as $action) {
            $instance = new $action;
            $name = $instance->name();
            $this->instances[$name] = $instance;
        }
    }

    /**
     * Get the action instances.
     *
     * @param  string  $action
     * @return void
     */
    public function get(string $action = null)
    {
        return $action ? $this->instances[$action] : $this->instances;
    }

    /**
     * Check has the action.
     *
     * @param  string  $action
     * @return boolean
     */
    public function has(string $action)
    {
        return isset($this->instances[$action]);
    }

    /**
     * Using the call string.
     *
     * @return array
     */
    public function __toString()
    {
        return $this->instances;
    }
}
