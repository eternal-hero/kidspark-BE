<?php

namespace App\Http\Requests\Guardians\JobRequests;


use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class RefuseRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
        ];
    }

    public function rules()
    {
        return [
            'reason' => 'required|integer',
            'reason_detail' => 'required|string',
        ];
    }
}
