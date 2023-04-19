<?php

namespace App\Http\Requests\Admin\Supporter\ProfileImageRequests;

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

    public function attributes()
    {
        return [
            'supporter_user_id' => 'パークサポーターID',
            'image_path' => '画像パス',
        ];
    }

    public function rules()
    {
        return [
            'supporter_user_id' => 'required | integer',
            'image_path' => 'required',
        ];
    }
}
