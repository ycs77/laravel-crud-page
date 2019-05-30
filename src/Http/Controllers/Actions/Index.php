<?php

namespace Ycs77\LaravelCrudPage\Http\Controllers\Actions;

use Ycs77\LaravelCrudPage\Actions\CreateAction;

trait Index
{
    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 15;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = $this->getModel()->makeHidden($this->tableHiddenFields);
        $this->setModel($model);

        $table = $this->getTable($this->getIndexTableFields())
            ->paginate($this->perPage);
        $createAction = new CreateAction();

        return view($this->getViewName('index'), [
            'crudSlug' => $this->slug,
            'table' => $table,
            'createAction' => $createAction,
        ]);
    }

    /**
     * Get index table fields.
     *
     * @return array
     */
    protected function getIndexTableFields()
    {
        return $this->getTableFields();
    }
}
