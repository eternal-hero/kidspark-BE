<?php

namespace App\Http\Requests\Supporter\SickChildCare\SettingRequests;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
{
    public function authorize()
    {
        // Check authorization for supporter_user_id
        return true;
    }

    public function attributes()
    {
        return [];
    }

    public function rules()
    {
        return [
            'is_sick_child_care' => ['required', Rule::in([0, 1])],
            'single_fee' => 'required | integer',
            'regular_fee' => 'required | integer',
            'special' => 'nullable | string',
            'service' => 'nullable | string'
        ];
    }
}
