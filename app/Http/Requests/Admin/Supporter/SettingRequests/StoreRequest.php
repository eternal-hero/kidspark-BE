<?php

namespace App\Http\Requests\Admin\Supporter\SettingRequests;

use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends CustomFormRequest
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
            'settings_id' => 'nullable |inside_settings_id',
            'supporter_user_id' => 'required|integer',
            'is_supporter' => ['required', Rule::in([0, 1])],
            'single_fee' => 'required|integer',
            'regular_fee' => 'required|integer',
            'minimum_age_limit' => 'required|integer',
            'maximum_age_limit' => 'required|integer'
        ];
    }
}
