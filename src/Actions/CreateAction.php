<?php

namespace Ycs77\LaravelCrudPage\Actions;

class CreateAction extends Action
{
    /**
     * Get action name.
     *
     * @return string
     */
    public function name()
    {
        return 'create';
    }

    /**
     * Get action text.
     *
     * @return string
     */
    public function text()
    {
        return __('crudpage::text.create');
    }

    /**
     * Get action icon.
     *
     * @return string
     */
    public function icon()
    {
        return 'fas fa-plus-circle';
    }

    /**
     * Get action button color.
     * (default is bootstrap options: primary...)
     *
     * @return string
     */
    public function color()
    {
        return 'success';
    }
}
