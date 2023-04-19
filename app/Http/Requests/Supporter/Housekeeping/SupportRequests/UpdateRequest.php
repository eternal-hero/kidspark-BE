<?php

namespace App\Http\Requests\Supporter\Housekeeping\SupportRequests;


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

    public function attributes(){
        return [
            'acceptance_condition' => '受け入れ条件の説明文',
        ];
    }

    public function rules()
    {
        return [
            'acceptance_condition' => '',
            'supported_service' => 'nullable | string'
        ];
    }
}
