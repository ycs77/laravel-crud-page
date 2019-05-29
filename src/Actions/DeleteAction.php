<?php

namespace Ycs77\LaravelCrudPage\Actions;

class DeleteAction extends Action
{
    /**
     * Get action name.
     *
     * @return string
     */
    public function name()
    {
        return 'destroy';
    }

    /**
     * Get action text.
     *
     * @return string
     */
    public function text()
    {
        return __('crudpage::text.delete');
    }

    /**
     * Get action icon.
     *
     * @return string
     */
    public function icon()
    {
        return 'fas fa-trash';
    }

    /**
     * Get action button color.
     * (default is bootstrap options: primary...)
     *
     * @return string
     */
    public function color()
    {
        return 'danger';
    }
}
