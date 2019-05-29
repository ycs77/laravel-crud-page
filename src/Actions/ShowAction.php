<?php

namespace Ycs77\LaravelCrudPage\Actions;

class ShowAction extends Action
{
    /**
     * Get action name.
     *
     * @return string
     */
    public function name()
    {
        return 'show';
    }

    /**
     * Get action text.
     *
     * @return string
     */
    public function text()
    {
        return __('crudpage::text.show');
    }

    /**
     * Get action icon.
     *
     * @return string
     */
    public function icon()
    {
        return 'fas fa-eye';
    }

    /**
     * Get action button color.
     * (default is bootstrap options: primary...)
     *
     * @return string
     */
    public function color()
    {
        return 'warning';
    }
}
