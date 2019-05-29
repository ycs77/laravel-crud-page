<?php

namespace Ycs77\LaravelCrudPage\Http\Controllers\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait Create
{
    /**
     * Created redirect CRUD route.
     *
     * @var string|array
     */
    protected $createRedirectRoute = 'index';

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->initModel($request);
        $this->setFormFields($this->getCreateFormFields());
        $form = $this->getCreateForm();

        return view($this->getViewName('create'), [
            'crudSlug' => $this->slug,
            'form' => $form,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->initModel($request);
        $this->setFormFields($this->getCreateFormFields());

        $data = $this->validateFormData($request);
        $data = $this->storeFiles($request, $data);
        $data = $this->filterCreateData($data);

        $res = $this->createModel($this->model, $data);

        return $this->sendCreateResponse($res);
    }

    /**
     * Get create form.
     *
     * @return \Kris\LaravelFormBuilder\Form
     */
    protected function getCreateForm()
    {
        return $this->getForm('store', 'POST');
    }

    /**
     * Get create form fields.
     * 
     * @return array
     */
    protected function getCreateFormFields()
    {
        return $this->formFields();
    }

    /**
     * Custom filter create data.
     *
     * @param  array  $data
     * @return array
     */
    protected function filterCreateData(array $data)
    {
        return $this->filterPostData($data);
    }

    /**
     * Create the model.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  array  $data
     * @return bool
     */
    protected function createModel(Model $model, array $data)
    {
        return (bool)$model->create($data);
    }

    /**
     * Send the create response.
     *
     * @param  bool  $is_success
     * @return \Illuminate\Http\Response
     */
    protected function sendCreateResponse($is_success = true)
    {
        return $this->sendResponse(
            $this->createRedirectRoute,
            $is_success ? $this->createSuccess() : $this->createError()
        );
    }
}
