<?php

namespace App\Http\Requests\Supporter\Setting\OptionRequests;

use App\Http\Requests\CustomFormRequest;

class UpdateAllRequest extends CustomFormRequest
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
            '*.settings_id' => 'required | between:1,4',
            '*.subject_type' => 'required | integer',
            '*.option_content' => 'required | string',
            '*.additional_fee' => 'required | integer',
            '*.unit' => 'required | integer'
        ];
    }
}
