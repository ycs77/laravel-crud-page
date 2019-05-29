<?php

namespace Ycs77\LaravelCrudPage;

use KABBOUCHI\TableView\TableView as BaseTableView;

class TableView extends BaseTableView
{
    /**
     * CRUD resource slug.
     *
     * @var string
     */
    protected $crudSlug;

    /**
     * Actions name.
     *
     * @var array
     */
    protected $actions = [
        Actions\ShowAction::class,
        Actions\EditAction::class,
        Actions\DeleteAction::class,
    ];

    /**
     * Actions instance.
     *
     * @var \Ycs77\LaravelCrudPage\Actions\Actions
     */
    protected $actionsInstance;

    /**
     * Can show the actions.
     *
     * @var bool
     */
    protected $isShowActions = true;

    /**
     * Create table instance.
     *
     * @param mixed   $data
     * @param string  $crudSlug
     */
    public function __construct($data, string $crudSlug)
    {
        parent::__construct($data);

        $this->crudSlug = $crudSlug;
        $this->classes = config('tableView.class');
        $this->actions($this->actions);
    }

    /**
     * Set & Get actions instance.
     *
     * @param  array|null  $actions
     * @return \Ycs77\LaravelCrudPage\Actions\Actions
     */
    public function actions($actions = null)
    {
        if ($actions) {
            $this->actions = $actions;
            $this->actionsInstance = new Actions\Actions($this->actions);
        }

        return $this->actionsInstance;
    }

    /**
     * Get can show the actions.
     *
     * @return  bool
     */
    public function isShowActions()
    {
        return $this->isShowActions;
    }

    /**
     * Set can show the actions.
     *
     * @param  bool  $isShowActions
     * @return void
     */
    public function setIsShowActions(bool $isShowActions)
    {
        $this->isShowActions = $isShowActions;
    }

    /**
     * Render table view.
     *
     * @param  int|null $id
     * @return \Illuminate\View\View
     */
    public function render($id = null)
    {
        if (count($this->columns) === 0) {
            if ($this->collection->count() > 0) {
                $array = $this->collection->first()->toArray();

                foreach ($array as $key => $value) {
                    $this->column(str_replace('_', ' ', ucfirst($key)), $key);
                }
            }
        }
        $this->id = !$id ? $id : 'table-' . str_random(6);

        return view('tableView::index', [
            'tableView' => $this,
            'crudSlug' => $this->crudSlug,
        ]);
    }
}
