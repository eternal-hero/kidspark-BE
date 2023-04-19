<?php

namespace App\Http\Requests\Guardians\ProfileImageRequests;


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
            'guardian_profiles_id' => 'プロフィールID',
            'image_path' => '画像パス',
            'which_image' => '写真の種類',
            'is_examination' => '審査フラグ'
        ];
    }

    public function rules()
    {
        return [
            'image_path' => 'required',
            'which_image' => 'required | integer',
            'is_examination' => 'required | integer'
        ];
    }
}
