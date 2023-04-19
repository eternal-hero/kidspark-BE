<?php

namespace App\Http\Requests\Admin\Supporter\ChildbirthCare\SettingRequests;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class UpdateRequest extends BaseRequest
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
            'supporter_user_id' => 'required | integer',
            'is_childbirth_care' => ['required', Rule::in([0, 1])],
            'single_fee' => 'required | integer',
            'regular_fee' => 'required | integer',
            'special' => 'nullable | string',
            'service' => 'nullable | string'
        ];
    }
}
