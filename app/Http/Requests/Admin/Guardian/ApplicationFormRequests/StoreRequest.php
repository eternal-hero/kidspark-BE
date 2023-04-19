<?php

namespace App\Http\Requests\Admin\Guardian\ApplicationFormRequests;


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
            'status' => 'ステータス (-1: 不受理, 0:未対応, 1:対応済み)',
            'memo' => 'メモ',
            'updated_at' => '最終更新日時',
            'subject' => '申請件名',
            'sender' => '送信者',
            'member_id' => '会員ID',
            'detail' => '内容',
            'file_path' => 'ファイルパス'
        ];
    }

    public function rules()
    {
        return [
            'guardian_user_id' => 'required | integer',
            'status' => 'required | integer',
            'memo' => 'required',
            'updated_at' => 'required| date',
            'subject' => 'required',
            'sender' => 'required',
            'member_id' => 'required | integer',
            'detail' => 'required',
            'file_path' => 'required'
        ];
    }
}
