<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Validation\Rule;
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
