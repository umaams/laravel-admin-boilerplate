<?php

namespace Modules\Role\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'description' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('role::field.name'),
            'display_name' => __('role::field.display_name'),
            'description' => __('role::field.description'),
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
