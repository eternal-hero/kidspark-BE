<?php

namespace App\Http\Requests\Admin\Guardian\UserRequests;


use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class IndexRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
        ];
    }

    public function rules()
    {
        return [
            'user' => 'nullable | string',
            'usage_result' => 'nullable | integer',
            'prefecture' => 'nullable | string',
            'is_camera' => 'nullable | integer',
            'emergency_contact_phone_number' => 'nullable | string',
            'child_age' => 'nullable '
        ];
    }
}
