<?php

namespace App\Http\Requests\BeforeLogin\Guardian\GuardianUserRequests;


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

            'title' => 'タイトル',
            'file' => '補助書類',
            'main_files' => '本人確認書類',
            'mail_address' => 'メールアドレス',
        ];
    }

    public function rules()
    {
        return [
            'title' => 'required|numeric',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,heic,pdf',
            'main_files' => 'required',
            'main_files.*' => 'file|mimes:jpeg,png,jpg,heic,pdf',
            'mail_address' => 'required|unique:guardian_users',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必ず入力して下さい。',
            'title.numeric' => 'タイトルは数値で入力して下さい。',
            'mimes' => 'ファイルはjpeg,png,jpg,heic,pdfのものを選択して下さい。',
            'file' => 'ファイルを選択して下さい。',
            'main_files.*.required' => 'ファイルはjpeg,png,jpg,heic,pdfのものを選択して下さい。',
            'mail_address.unique' => '登録済のメールアドレスです。',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $data['status']['code'] = 400;
        $data['status']['message'] = $validator->errors()->toArray();

        throw new HttpResponseException(response()->json($data, 400));
    }
}
