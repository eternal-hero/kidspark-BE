<?php

namespace App\Http\Requests\Admin\Supporter\SickChildCare\SettingRequests;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [];
    }

    public function rules()
    {
        return [
            'settings_id' => 'nullable | inside_settings_id',
            'supporter_user_id' => 'required | integer',
            'is_sick_child_care' => ['required', Rule::in([0, 1])],
            'single_fee' => 'required | integer',
            'regular_fee' => 'required | integer',
            'special' => 'nullable | string',
            'service' => 'nullable | string'
        ];
    }
}
