<?php

namespace Modules\Menu\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
            'link' => 'required',
            'parent_menu_id' => 'required',
            'permission_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('menu::field.name'),
            'link' => __('menu::field.link'),
            'parent_menu_id' => __('menu::field.parent_menu_id'),
            'permission_id' => __('menu::field.permission_id')
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
