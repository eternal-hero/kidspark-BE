<?php

namespace App\Http\Requests\Admin\Supporter\UserRequests;

use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends CustomFormRequest
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
            'gender' => ['required', Rule::in([0, 1])],
            'birthday' => 'required|date',
            'post_code' => 'required|max:255',
            'prefecture' => 'required|max:255',
            'municipality' => 'required|max:255',
            'street_name' => 'required|max:255',
            'phone_number' => 'required|numeric|digits_between:1,15',
            'mail_address' => 'required|email|max:255|unique:supporter_users',
            'supporter_id' => 'required|max:255',
            'password' => 'required|max:255',
        ];
    }
}
