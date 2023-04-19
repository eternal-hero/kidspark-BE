<?php

namespace App\Http\Requests\Guardians\ChildRequests;


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
        return [
            'guardian_user_id' => '保護者ID',
            'first_name' => '名前',
            'last_name' => '姓',
            'first_kana' => '名前 ふりがな',
            'last_kana' => '姓 ふりがな',
            'gender' => '性別',
            'nickname' => '愛称',
            'birthday' => '生年月日',
            'allergy' => 'アレルギー',
            'chronic_disease' => '持病',
            'other' => 'その他/配慮事項'
        ];
    }

    public function rules()
    {
        return [
            'guardian_user_id' => 'required | integer',
            'first_name' => 'required',
            'last_name' => 'required',
            'first_kana' => 'required',
            'last_kana' => 'required',
            'gender' => 'required | integer',
            'nickname' => 'required',
            'birthday' => 'required | date',
            'allergy' => 'nullable',
            'chronic_disease' => 'nullable',
            'other' => 'nullable'
        ];
    }
}
