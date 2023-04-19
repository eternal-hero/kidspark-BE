<?php

namespace App\Http\Requests\Admin\Common\InoculationStatusRequests;

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
            "inoculation_times" => 'nullable|integer',
            "inoculation_on" => "nullable|date",
            "is_publish" => [
                'nullable',
                Rule::in([0, 1])
            ]
        ];
    }
}
