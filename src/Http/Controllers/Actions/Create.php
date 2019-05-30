<?php

namespace Ycs77\LaravelCrudPage\Http\Controllers\Actions;

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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->initStaticModel();
        $this->setFormFields($this->getCreateFormFields());

        $data = $this->validateFormData();
        $data = $this->storeFiles($data);
        $data = $this->filterCreateData($data);

        $res = $this->createModel($data);

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
     * @param  array  $data
     * @return bool
     */
    protected function createModel(array $data)
    {
        return (bool)$this->model->create($data);
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
