<?php

namespace App\Http\Requests\Admin\Supporter\UserRequests;

use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class UpdatePasswordRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [];
    }

    public function rules()
    {
        return [
            'password' => 'max:225',
        ];
    }
}
