<?php

namespace App\Http\Requests\Admin\Supporter\ProfileImageRequests;

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

    public function attributes()
    {
        return [
            'image_path' => '画像パス',
        ];
    }

    public function rules()
    {
        return [
            'image_path' => 'required',
        ];
    }
}
