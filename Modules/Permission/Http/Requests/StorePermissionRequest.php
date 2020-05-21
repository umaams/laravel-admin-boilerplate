<?php

namespace Modules\Permission\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:permissions,name',
            'display_name' => 'required',
            'description' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('permission::field.name'),
            'display_name' => __('permission::field.display_name'),
            'description' => __('permission::field.description'),
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
