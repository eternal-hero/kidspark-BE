<?php

namespace App\Http\Requests\BeforeLogin\Guardian\TmpGuardianUserRequests;


use App\Http\Requests\CustomFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResendAuthCodeRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [

            'mail_address' => 'メールアドレス',
        ];
    }

    public function rules()
    {
        return [
            'mail_address' => 'required|exists:tmp_guardian_users',
        ];
    }

    public function messages()
    {
        return [
            'mail_address.required' => 'メールアドレスは必ず入力して下さい。',
            'mail_address.exists' => '登録されていないメールアドレスです',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $data['status']['code'] = 400;
        $data['status']['message'] = $validator->errors()->toArray();

        throw new HttpResponseException(response()->json($data, 400));
    }
}
