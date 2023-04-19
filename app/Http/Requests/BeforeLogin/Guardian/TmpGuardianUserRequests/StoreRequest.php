<?php

namespace App\Http\Requests\BeforeLogin\Guardian\TmpGuardianUserRequests;


use App\Http\Requests\CustomFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends CustomFormRequest
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
            'mail_address' => 'required|unique:guardian_users|email:filter,dns',
        ];
    }

    public function messages()
    {
        return [
            'mail_address.required' => 'メールアドレスは必ず入力して下さい。',
            'mail_address.unique' => '既に使用されているメールアドレスです。',
            'mail_address.email' => '入力形式が間違っています。',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $data['status']['code'] = 400;
        $data['status']['message'] = $validator->errors()->toArray();

        throw new HttpResponseException(response()->json($data, 400));
    }
}
