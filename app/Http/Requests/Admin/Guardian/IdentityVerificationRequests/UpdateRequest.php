<?php

namespace App\Http\Requests\Admin\Guardian\IdentityVerificationRequests;


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
            'status' => 'ステータス',
            'memo' => 'メモ',
            'title' => '名称',
            'request_at' => '申請日時',
            'expiration_on' => '有効期限',
            'additional_file_path' => '補助書類'
        ];
    }

    public function rules()
    {
        return [
            'status' => 'required  | integer',
            'memo' => 'nullable',
            'title' => 'required  | integer',
            'request_at' => 'required | date',
            'expiration_on' => 'required | date',
            'additional_file_path' => 'required'
        ];
    }
}
