<?php

namespace App\Http\Requests\BeforeLogin\Guardian\TmpGuardianUserRequests;


use App\Http\Requests\CustomFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [

            "first_name" => "氏",
            "last_name" => "名",
            "first_kana" => "氏　かな",
            "last_kana" => "氏　かな",
            "nickname" => "ニックネーム",
            "gender" => "性別",
            "relation" => "子供との関係",
            "birthday" => "生年月日",
            "post_code" => "郵便番号",
            "prefecture" => "都道府県",
            "municipality" => "市区町村",
            "street_name" => "町名番地",
            "building" => "建物名",
            "contact_phone_number" => "連絡先電話番号",
            "mail_address" => "メールアドレス",
            "password" => "パスワード",
        ];
    }

    public function rules()
    {
        return [
            "first_name" => "required",
            "last_name" => "required",
            "first_kana" => "required|regex:/^[ぁ-ん]+$/u",
            "last_kana" => "required|regex:/^[ぁ-ん]+$/u",
            "nickname" => "required",
            "gender" => "required|numeric",
            "relation" => "required",
            "birthday" => "required|date",
            "post_code" => "required",
            "prefecture" => "required",
            "municipality" => "required",
            "street_name" => "required",
            "contact_phone_number" => "required",
            "mail_address" => "required|exists:tmp_guardian_users",
            "password" => "required",
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必ず入力して下さい。',
            'regex' => ':attributeはひらがなで入力して下さい。',
            'date' => ':attributeの入力形式が間違っています。',
            'mail_address.exists' => '登録のないメールアドレスです。'
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $data['status']['code'] = 400;
        $data['status']['message'] = $validator->errors()->toArray();

        throw new HttpResponseException(response()->json($data, 400));
    }
}
