<?php

namespace App\Http\Requests\Admin\Supporter\Housekeeping\SettingRequests;


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
            'supporter_user_id' => 'パークサポーターID',
            'is_housework' => '家事代行フラグ',
            'single_fee' => '単発予約の料金',
            'regular_fee' => '定期予約の料金',
            'special'=>'特典設定の説明',
            'service'=>'サービス説明'
        ];
    }

    public function rules()
    {
        return [
            'settings_id' => 'nullable | inside_settings_id',
            'supporter_user_id' => 'required | integer',
            'is_housework' => 'required | boolean',
            'single_fee' => 'required | integer',
            'regular_fee' => 'required | integer',
            'special'=>'string',
            'service'=>'string'
        ];
    }
}
