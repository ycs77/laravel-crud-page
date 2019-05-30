<?php

namespace Ycs77\LaravelCrudPage\Http\Controllers\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

trait Delete
{
    /**
     * Deleted redirect CRUD route.
     *
     * @var string|array
     */
    protected $deleteRedirectRoute = 'index';

    /**
     * Remove the specified resource from storage.
     *
     * @param  int|array  $ids
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids)
    {
        $resAry = collect([]);

        foreach (Arr::wrap($ids) as $id) {
            $model = $this->getModel($id);
            $destroyRes = $this->destroyModel($model);
            $resAry->push($destroyRes);
        }

        $res = $resAry->every(function ($value) {
            return (bool)$value;
        });

        return $this->sendDestroyResponse($res);
    }

    /**
     * Destroy the model.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return bool
     */
    protected function destroyModel(Model $model)
    {
        return $model->delete();
    }

    /**
     * Send the destroy response.
     *
     * @param  bool  $is_success
     * @return \Illuminate\Http\Response
     */
    protected function sendDestroyResponse($is_success = true)
    {
        return $this->sendResponse(
            $this->deleteRedirectRoute,
            $is_success ? $this->deleteSuccess() : $this->deleteError()
        );
    }
}
