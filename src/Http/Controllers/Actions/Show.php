<?php

namespace Ycs77\LaravelCrudPage\Http\Controllers\Actions;

use Illuminate\Http\Request;
use Ycs77\LaravelCrudPage\Actions;

trait Show
{
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $model = $this->getModel($request, $id)->makeHidden($this->tableHiddenFields);
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
