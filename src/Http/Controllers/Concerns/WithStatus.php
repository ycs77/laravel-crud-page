<?php

namespace Ycs77\LaravelCrudPage\Http\Controllers\Concerns;

trait WithStatus
{
    /**
     * Return message
     *
     * @param  string $status
     * @param  string $message
     * @return array
     */
    protected function message($status, $message)
    {
        return [
            'type'    => $status,
            'message' => $message,
        ];
    }

    /**
     * Return success message
     *
     * @param  string $message
     * @return array
     */
    protected function success($message)
    {
        return $this->message('success', $message);
    }

    /**
     * Return error message
     *
     * @param  string $message
     * @return array
     */
    protected function error($message)
    {
        return $this->message('error', $message);
    }

    /**
     * Return create success message
     *
     * @param  string $message
     * @return array
     */
    protected function createSuccess($message = null)
    {
        return $this->success($message ?? __('crudpage::text.create_success'));
    }

    /**
     * Return create error message
     *
     * @param  string $message
     * @return array
     */
    protected function createError($message = null)
    {
        return $this->error($message ?? __('crudpage::text.create_error'));
    }

    /**
     * Return update success message
     *
     * @param  string $message
     * @return array
     */
    protected function updateSuccess($message = null)
    {
        return $this->success($message ?? __('crudpage::text.update_success'));
    }

    /**
     * Return update error message
     *
     * @param  string $message
     * @return array
     */
    protected function updateError($message = null)
    {
        return $this->error($message ?? __('crudpage::text.update_error'));
    }

    /**
     * Return delete success message
     *
     * @param  string $message
     * @return array
     */
    protected function deleteSuccess($message = null)
    {
        return $this->success($message ?? __('crudpage::text.delete_success'));
    }

    /**
     * Return delete error message
     *
     * @param  string $message
     * @return array
     */
    protected function deleteError($message = null)
    {
        return $this->error($message ?? __('crudpage::text.delete_error'));
    }
}
