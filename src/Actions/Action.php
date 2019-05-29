<?php

namespace Ycs77\LaravelCrudPage\Actions;

use Ycs77\LaravelCrudPage\Facades\CrudPage;
use Ycs77\LaravelCrudPage\Http\Controllers\Concerns\Routes;

abstract class Action
{
    use Routes;

    /**
     * Action view path.
     *
     * @var string
     */
    protected $view = 'tableView::action';

    /**
     * Get action name.
     *
     * @return string
     */
    abstract public function name();

    /**
     * Get action text.
     *
     * @return string
     */
    abstract public function text();

    /**
     * Get action icon.
     *
     * @return string
     */
    abstract public function icon();

    /**
     * Get action CRUD url.
     *
     * @param  string    $slug
     * @param  int|null  $id
     * @return string
     */
    public function url($slug, $id = null)
    {
        return route(CrudPage::getCrudRoute($slug, $this->name()), $id);
    }

    /**
     * Get action color class.
     *
     * @return string
     */
    abstract public function color();

    /**
     * Get action is displayed.
     *
     * @param  string  $slug
     * @return bool
     */
    public function displayed($slug)
    {
        return CrudPage::hasCrudRoute($slug, $this->name());
    }

    /**
     * Render action view.
     *
     * @param  \Ycs77\LaravelCrudPage\Actions\Action  $action
     * @param  string    $slug
     * @param  int|null  $id
     * @return \Illuminate\View\View
     */
    public function render(Action $action, string $slug, $id = null)
    {
        $crudSlug = $slug;
        return view($this->view, compact('action', 'crudSlug', 'id'));
    }
}
