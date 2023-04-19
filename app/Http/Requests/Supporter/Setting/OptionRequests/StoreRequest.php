<?php

namespace App\Http\Requests\Supporter\Setting\OptionRequests;

use App\Http\Requests\CustomFormRequest;

class StoreRequest extends CustomFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'supporter_user_id' => 'required|integer',
            'settings_id' => 'required | inside_settings_id',
            'subject_type' => 'required | integer',
            'option_content' => 'required | string',
            'additional_fee' => 'required | integer',
            'unit' => 'required | integer'
        ];
    }
}
