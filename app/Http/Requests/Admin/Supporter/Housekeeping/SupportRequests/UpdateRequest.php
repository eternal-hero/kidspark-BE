<?php

namespace App\Http\Requests\Admin\Supporter\Housekeeping\SupportRequests;


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
            'supporter_user_id' => 'パークサポーターID',
            'acceptance_condition' => '受け入れ条件の説明文',
            'supported_service' => '対応可能サービス',
        ];
    }

    public function rules()
    {
        return [
            'supporter_user_id' => 'required | integer',
            'acceptance_condition' => '',
            'supported_service' => 'nullable | string',
        ];
    }
}
