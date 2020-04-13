<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$this->route('id').',id',
            'role_id' => 'required|exists:roles,id'
        ];
    }

    public function attributes()
    {
        return [
            'name' => @lang('user::field.name'),
            'email' => @lang('user::field.email'),
            'role_id' => @lang('user::field.role_id'),
            'timezone_code' => @lang('user::field.timezone_code'),
            'language_code' => @lang('user::field.language_code')
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
