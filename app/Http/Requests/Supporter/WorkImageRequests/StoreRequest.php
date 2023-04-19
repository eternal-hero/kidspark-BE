<?php

namespace App\Http\Requests\Supporter\WorkImageRequests;


use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends CustomFormRequest
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
            'supporter_user_id' => 'パークサポーターID',
            'display_status' => '表示ステータス',
            'note' => 'メモ',
            'category' => 'カテゴリー',
            'image_path' => '画像パス'
        ];
    }

    public function rules()
    {
        return [
            'display_status' => 'nullable|integer',
            'note' => 'nullable|string',
            'category' => 'nullable|integer',
            'image_path' => 'nullable|string'
        ];
    }
}
