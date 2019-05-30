<?php

namespace Ycs77\LaravelCrudPage\Http\Controllers\Actions;

use Illuminate\Database\Eloquent\Model;

trait Edit
{
    /**
     * Updated redirect CRUD route.
     *
     * @var string|array
     */
    protected $updateRedirectRoute = ['index', 'back'];

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->initModel($id);
        $this->setFormFields($this->getEditFormFields());
        $form = $this->getEditForm($this->model, $id);

        return view($this->getViewName('edit'),[
            'crudSlug' => $this->slug,
            'model' => $this->model,
            'form' => $form,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->initModel($id);
        $this->setFormFields($this->getEditFormFields());

        $data = $this->validateFormData();
        $data = $this->storeFiles($data);
        $data = $this->filterEditData($data);

        $res = $this->updateModel($this->model, $data);

        return $this->sendUpdateResponse($res);
    }

    /**
     * Get edit form.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  int|null  $id
     * @return \Kris\LaravelFormBuilder\Form
     */
    protected function getEditForm(Model $model, $id = null)
    {
        return $this->getForm('update', 'PUT', $model, $id);
    }

    /**
     * Get edit form fields.
     *
     * @return array
     */
    protected function getEditFormFields()
    {
        return $this->formFields();
    }

    /**
     * Custom filter edit data.
     *
     * @param  array  $data
     * @return array
     */
    protected function filterEditData(array $data)
    {
        return $this->filterPostData($data);
    }

    /**
     * Update the model.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  array  $data
     * @return bool
     */
    protected function updateModel(Model $model, array $data)
    {
        return $model->update($data);
    }

    /**
     * Send the update response.
     *
     * @param  bool  $is_success
     * @return \Illuminate\Http\Response
     */
    protected function sendUpdateResponse($is_success = true)
    {
        return $this->sendResponse(
            $this->updateRedirectRoute,
            $is_success ? $this->updateSuccess() : $this->updateError()
        );
    }
}
