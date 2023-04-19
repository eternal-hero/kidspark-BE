<?php

namespace App\Http\Requests\Admin\Supporter\OptionRequests;

use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends CustomFormRequest
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
            'settings_id' => 'required | inside_settings_id',
            'subject_type' => 'integer',
            'option_content' => 'string',
            'additional_fee' => 'integer',
            'unit' => 'integer'
        ];
    }
}
