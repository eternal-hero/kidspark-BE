<?php

namespace App\Http\Requests\Admin\Supporter\WorkImageRequests;


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
            'display_status' => '表示ステータス',
            'note' => 'メモ',
            'category' => 'カテゴリー',
            'image_path' => '画像パス'
        ];
    }

    public function rules()
    {
        return [
            'display_status' => 'required | integer',
            'note' => '',
            'category' => 'required | integer',
            'image' => 'nullable|mimes:mp4,mov,jpg,png,jpeg,heic',
            'image_path' => 'nullable|string'
        ];
    }
}
