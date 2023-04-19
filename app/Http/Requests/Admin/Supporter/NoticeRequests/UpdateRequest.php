<?php

namespace App\Http\Requests\Admin\Supporter\NotiveRequests;


use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends CustomFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function attributes(){
        return [
            'is_request' => 'リクエスト通知の受け取りフラグ',
            'is_task' => '掲示板お仕事通知の受け取りフラグ',
            'is_management' => '運営からのお知らせの受け取りフラグ',
            'is_parent' => '保護者からのメッセージの受け取りフラグ'
        ];
    }

    public function rules()
    {
        return [
            'is_request' => 'required | boolean',
            'is_task' => 'required | boolean',
            'is_management' => 'required | boolean',
            'is_parent' => 'required | boolean'
        ];
    }
}
