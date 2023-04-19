<?php

namespace App\Http\Requests\BeforeLogin\Guardian\TmpGuardianUserRequests;


use App\Http\Requests\CustomFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class VerificationEmailRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [

            'mail_auth' => 'メールアドレス',
            'auth_code' => '認証コード',
        ];
    }

    public function rules()
    {
        return [
            'mail_address' => 'required|exists:tmp_guardian_users',
            'auth_code' => 'required|digits:6',
        ];
    }

    public function messages()
    {
        return [
            'mail_address.required' => 'メールアドレスは必ず入力して下さい。',
            'mail_address.exists' => '登録が無いメールアドレスです。',
            'auth_code.required' => '認証コードを入力して下さい。',
            'auth_code.digits' => '認証コードは6桁の半角数字で入力して下さい。',

        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $data['status']['code'] = 400;
        $data['status']['message'] = $validator->errors()->toArray();

        throw new HttpResponseException(response()->json($data, 400));
    }
}
