<?php

namespace App\Http\Requests\Admin\Guardian\NoticeRequests;


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
            'is_reserve' => '予約依頼メール',
            'is_bbs' => '掲示板お仕事通知',
            'is_message' => '保護者からのメッセージ',
            'is_kidspark' => 'キッズパークからのお知らせ'
        ];
    }

    public function rules()
    {
        return [
            'guardian_user_id' => 'required | integer',
            'is_reserve' => 'required | integer',
            'is_bbs' => 'required | integer',
            'is_message' => 'required | integer',
            'is_kidspark' => 'required | integer'
        ];
    }
}
