<?php

namespace App\Http\Requests\Admin\Supporter\SettingRequests;

use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends CustomFormRequest
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
            'supporter_user_id' => 'required|integer',
            'is_supporter' => Rule::in([0, 1]),
            'single_fee' => 'integer',
            'regular_fee' => 'integer',
            'minimum_age_limit' => 'integer',
            'maximum_age_limit' => 'integer'
        ];
    }
}
