<?php

namespace Ycs77\LaravelCrudPage\Actions;

class EditAction extends Action
{
    /**
     * Get action name.
     *
     * @return string
     */
    public function name()
    {
        return 'edit';
    }

    /**
     * Get action text.
     *
     * @return string
     */
    public function text()
    {
        return __('crudpage::text.edit');
    }

    /**
     * Get action icon.
     *
     * @return string
     */
    public function icon()
    {
        return 'fas fa-edit';
    }

    /**
     * Get action button color.
     * (default is bootstrap options: primary...)
     *
     * @return string
     */
    public function color()
    {
        return 'primary';
    }
}
