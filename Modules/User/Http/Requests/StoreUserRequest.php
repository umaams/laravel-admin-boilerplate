<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'timezone_code' => 'required',
            'language_code' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('user::field.name'),
            'email' => __('user::field.email'),
            'role_id' => __('user::field.role_id'),
            'password' => __('user::field.password'),
            'password_confirmation' => __('user::field.password_confirmation'),
            'timezone_code' => __('user::field.timezone_code'),
            'language_code' => __('user::field.language_code')
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
