<?php

namespace App\Http\Requests\Guardians\UserRequests;


use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'first_name' => '名前',
            'last_name' => '姓',
            'nickname' => 'ニックネーム',
            'gender' => '性別',
            'relation' => '続柄',
            'post_code' => '郵便番号',
            'prefecture' => '都道府県',
            'municipality' => '市区町村',
            'street_name' => '丁目・番地・号',
            'building' => '建物名',
            'contact_phone_number' => '連絡先電話番号',
            'mail_address' => 'メールアドレス',
            'workspace' => '勤務先',
            'family_structure' => '家族構成',
            'is_pets' => 'ペットの有無',
            'is_camera' => 'カメラ設置',
            'emergency_contact_name' => '緊急連絡先の名前',
            'emergency_contact_phone_number' => '緊急連絡先の電話番号',
            'emergency_contact_relation' => '登録者との関係'
        ];
    }

    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'nickname' => 'required',
            'gender' => 'required | integer',
            'relation' => 'required',
            'post_code' => 'required',
            'prefecture' => 'required',
            'municipality' => 'required',
            'street_name' => 'required',
            'building' => 'nullable',
            'contact_phone_number' => 'required',
            'mail_address' => 'required',
            'workspace' => 'nullable',
            'family_structure' => 'required',
            'is_pets' => 'required | boolean',
            'is_camera' => 'required | boolean',
            'emergency_contact_name' => 'required',
            'emergency_contact_phone_number' => 'required',
            'emergency_contact_relation' => 'required'
        ];
    }
}
