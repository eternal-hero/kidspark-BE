<?php

namespace App\Http\Requests\Admin\Supporter\Result\ReviewRequests;


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
            'post_at' => '投稿日',
            'is_publish' => '公開フラグ',
            'rating' => '評価',
        ];
    }

    public function rules()
    {
        return [
            'post_at' => 'required | date',
            'is_publish' => 'required | boolean',
            'rating' => 'required | integer',
        ];
    }
}
