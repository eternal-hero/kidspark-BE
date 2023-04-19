<?php

namespace App\Http\Requests\Supporter\JobCancelRequests;

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
        return [];
    }

    public function rules()
    {
        return [
            'reason' => 'required|integer',
            'reason_detail' => 'required|string',
        ];
    }
}
