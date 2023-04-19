<?php

namespace App\Http\Requests\Supporter\Housekeeping\SupportRequests;


use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

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

    public function attributes(){
        return [
            'settings_id' => '設定識別ID',
            'acceptance_condition' => '受け入れ条件の説明文',
            'supported_service' => '対応可能サービス',
        ];
    }

    public function rules()
    {
        return [
            'settings_id' => 'required | inside_settings_id',
            'acceptance_condition' => '',
            'supported_service' => 'nullable | string'
        ];
    }
}
