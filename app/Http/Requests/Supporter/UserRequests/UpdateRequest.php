<?php

namespace App\Http\Requests\Supporter\UserRequests;

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
        return [];
    }

    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'first_kana' => 'required|max:255',
            'last_kana' => 'required|max:255',
            'gender' => Rule::in([0, 1]),
            'birthday' => 'date',
            'post_code' => 'max:255',
            'prefecture' => 'max:255',
            'municipality' => 'max:255',
            'street_name' => 'max:255',
            'phone_number' => 'numeric|digits_between:1,15',
            'mail_address' => [
                'email', 'max:255',
                Rule::unique('supporter_users')->ignore($this->get('mail_address'), 'mail_address')
            ],
            'supporter_id' => 'max:255',
            'password' => 'max:225',
        ];
    }
}
