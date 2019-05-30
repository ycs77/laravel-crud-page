<?php

namespace Ycs77\LaravelCrudPage\Http\Controllers\Actions;

use Ycs77\LaravelCrudPage\Actions;

trait Show
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = $this->getModel($id)->makeHidden($this->tableHiddenFields);
        $this->setModel($model);

        $data = $this->getShowData();
        $actions = new Actions\Actions([
            Actions\EditAction::class,
            Actions\DeleteAction::class,
        ]);

        return view($this->getViewName('show'), [
            'crudSlug' => $this->slug,
            'model' => $this->model,
            'data' => $data,
            'actions' => $actions,
        ]);
    }

    /**
     * Get show data.
     *
     * @return array
     */
    protected function getShowData()
    {
        return $this->model->toArray();
    }
}
