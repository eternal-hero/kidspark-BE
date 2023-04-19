<?php

namespace App\Http\Requests\Guardians\UserRequests;


use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class UpdatePasswordRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password' => 'required|string|min:8|max:255',
            'new_password' => 'required|string|confirmed|min:8|max:255',
        ];
    }
}
