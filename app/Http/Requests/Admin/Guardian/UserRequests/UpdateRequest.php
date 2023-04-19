<?php

namespace App\Http\Requests\Admin\Guardian\UserRequests;


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
            'first_kana' => '名前 ふりがな',
            'last_kana' => '姓 ふりがな',
            'nickname' => 'ニックネーム',
            'gender' => '性別',
            'relation' => '続柄',
            'birthday' => '生年月日',
            'post_code' => '郵便番号',
            'prefecture' => '都道府県',
            'municipality' => '市区町村',
            'street_name' => '丁目・番地・号',
            'building' => '建物名',
            'contact_phone_number' => '連絡先電話番号',
            'mail_address' => 'メールアドレス',
            'password' => 'パスワード',
            'workspace' => '勤務先',
            'family_structure' => '家族構成',
            'is_pets' => 'ペットの有無',
            'housing_type' => '住所形態',
            'is_camera' => 'カメラ設置',
            'emergency_contact_name' => '緊急連絡先の名前',
            'emergency_contact_phone_number' => '緊急連絡先の電話番号',
            'emergency_contact_relation' => '登録者との関係',
            'status' => 'ステータス'
        ];
    }

    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'first_kana' => 'required',
            'last_kana' => 'required',
            'nickname' => 'required',
            'gender' => 'required | integer',
            'relation' => 'required',
            'birthday' => 'required | date',
            'post_code' => 'required',
            'prefecture' => 'required',
            'municipality' => 'required',
            'street_name' => 'required',
            'building' => 'nullable',
            'contact_phone_number' => 'required',
            'mail_address' => 'required',
            'password' => 'required',
            'workspace' => 'nullable',
            'family_structure' => 'required',
            'is_pets' => 'required | boolean',
            'housing_type' => 'required',
            'is_camera' => 'required | boolean',
            'emergency_contact_name' => 'required',
            'emergency_contact_phone_number' => 'required',
            'emergency_contact_relation' => 'required',
            'status' => 'required  | integer'
        ];
    }
}
