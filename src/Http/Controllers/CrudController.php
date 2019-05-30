<?php

namespace Ycs77\LaravelCrudPage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Ycs77\LaravelCrudPage\Facades\CrudPage;
use Ycs77\LaravelCrudPage\TableView;
use Ycs77\LaravelFormFieldType\Traits\FormFieldsTrait;

class CrudController extends Controller
{
    use FormFieldsTrait;
    use Actions\Index,
        Actions\Create,
        Actions\Show,
        Actions\Edit,
        Actions\Delete;
    use Concerns\WithStatus;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @var array
     */
    protected $formFields = [];

    /**
     * Fields hidden in the table.
     *
     * @var array
     */
    protected $tableHiddenFields = [
        'password',
        'email_verified_at',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    /**
     * Create base CRUD controller instance.
     */
    public function __construct()
    {
        $this->slug = $this->getSlug(request());
        $this->config = CrudPage::getCrudConfig($this->slug ?? 'default');
    }

    /**
     * Get resource slug.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function getSlug(Request $request)
    {
        if ($this->slug) {
            return $this->slug;
        } elseif (class_basename($this) !== 'CrudController') {
            return Str::snake(str_replace_last('Controller', '', class_basename($this)));
        }
    }

    /**
     * Initial model instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int|null $id
     * @return void
     */
    protected function initModel(Request $request, $id = null)
    {
        $this->setModel($this->getModel($request, $id));
    }

    /**
     * Set model instance.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    protected function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * Get model instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int|null $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    protected function getModel(Request $request, $id = null)
    {
        if (!$this->config['model']) {
            return;
        }

        $model = app($this->config['model']);
        return $id ? $model->find($id) : $model->all();
    }

    /**
     * Initial model instance.
     *
     * @return void
     */
    protected function initStaticModel()
    {
        $this->setStaticModel($this->getStaticModel());
    }

    /**
     * Set static model.
     *
     * @return void
     */
    protected function setStaticModel()
    {
        $this->model = $this->getStaticModel();
    }

    /**
     * Get static model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function getStaticModel()
    {
        if (!$this->config['model']) {
            return;
        }

        return app($this->config['model']);
    }

    /**
     * Get HTML table.
     *
     * @param  array  $tableFields
     * @return \Ycs77\LaravelCrudPage\TableView
     */
    public function getTable($tableFields = [])
    {
        $tableView = new TableView($this->model, $this->slug);

        if (count($tableFields)) {
            foreach ($tableFields as $key => $value) {
                $tableView->column($key, $value);
            }
        } else {
            if ($this->model->count() > 0) {
                $array = $this->model->first()->toArray();
                foreach ($array as $key => $value) {
                    $tableView->column(str_replace('_', ' ', ucfirst($key)), $key);
                }
            }
        }

        return $tableView;
    }

    /**
     * Get table fields.
     *
     * @return array
     */
    protected function getTableFields()
    {
        return [];
    }

    /**
     * Get HTML form.
     *
     * @param  string  $action
     * @param  string  $verb
     * @param  \Illuminate\Database\Eloquent\Model|null  $model
     * @param  int|null  $id
     * @return \Kris\LaravelFormBuilder\Form
     */
    protected function getForm(string $action, string $verb, Model $model = null, $id = null)
    {
        $route = CrudPage::getCrudRoute($this->slug, $action);
        return $this->renderForm([
            'url' => route($route, $id),
            'method' => $verb,
            'model' => $model,
        ]);
    }

    /**
     * Get form fields.
     * 
     * @return array
     */
    protected function formFields()
    {
        return [];
    }

    /**
     * Get form fields.
     * 
     * @return void
     */
    public function setFormFields($formFields)
    {
        $this->formFields = $formFields;
    }

    /**
     * Get form field array.
     *
     * @param  array|null $fields
     * @return array
     */
    public function getFormFields(array $fields = null)
    {
        return $fields ?? $this->formFields;
    }

    /**
     * Get view name.
     *
     * @param  string  $action
     * @return string
     */
    protected function getViewName(string $action)
    {
        $slug = Str::plural($this->slug);
        $view = $this->config['view_prefix']
            ? "{$this->config['view_prefix']} $action"
            : "{$this->config['views_prefix']}  $slug.$action";

        if (view()->exists($view)) {
            return $view;
        }

        return "crud-page::$action";
    }

    /**
     * Custom filter post data.
     *
     * @param  array  $data
     * @return array
     */
    protected function filterPostData(array $data)
    {
        return $data;
    }

    /**
     * Store upload files to storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $data
     * @return array
     */
    protected function storeFiles(Request $request, array $data)
    {
        foreach ($request->file() as $filename => $file) {
            $data[$filename] = $file->store($this->config['file_store']);
        }

        return $data;
    }

    /**
     * Send the response.
     *
     * @param  string|array  $routes
     * @param  mixed  $value
     * @return \Illuminate\Http\Response
     */
    protected function sendResponse($routes, $value)
    {
        if ($redirectRoute = $this->getRedirectRoute($routes)) {
            return redirect()->route($redirectRoute)->with('status', $value);
        }

        if ($redirect = $this->redirectBack($routes, $value)) {
            return $redirect;
        }

        abort(404);
    }

    /**
     * Redirect to back page.
     *
     * @param  string|array  $routes
     * @param  mixed  $value
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectBack($routes, $value)
    {
        foreach (Arr::wrap($routes) as $route) {
            if ($route === 'back') {
                return back()->with('status', $value);
            }
        }
    }

    /**
     * Get redirect route.
     *
     * @param  string|array  $routes
     * @param  bool  $isCrudRoute
     * @return string|null
     */
    protected function getRedirectRoute($routes, $isCrudRoute = true)
    {
        $redirectRoute = null;

        foreach (Arr::wrap($routes) as $route) {
            $route = $isCrudRoute
                ? CrudPage::getCrudRoute($this->slug, $route)
                : $route;

            if ($route) {
                $redirectRoute = $route;
                break;
            }
        }

        return $redirectRoute;
    }
}
