<?php

namespace App\Http\Requests\Guardians\Auth;

use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
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
            'mail_address' => 'required|email',
            'password' => 'required'
        ];
    }
}
