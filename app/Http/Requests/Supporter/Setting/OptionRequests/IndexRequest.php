<?php

namespace App\Http\Requests\Supporter\Setting\OptionRequests;

use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class IndexRequest extends CustomFormRequest
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
            'option_id' => 'nullable | integer',
            'settings_id' => 'nullable | inside_settings_id'
        ];
    }
}
