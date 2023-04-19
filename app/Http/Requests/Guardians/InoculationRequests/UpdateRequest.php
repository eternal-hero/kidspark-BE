<?php

namespace App\Http\Requests\Guardians\InoculationRequests;

use App\Http\Requests\CustomFormRequest;

class UpdateRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'inoculation_times' => '接種回数',
            'inoculation_on' => '接種',
            'is_publish' => '公開されています'
        ];
    }

    public function rules()
    {
        return [
            'inoculation_times' => 'required',
            'inoculation_on' =>'required | date',
            'is_publish' => 'required | boolean'
        ];
    }
}
