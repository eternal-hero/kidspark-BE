<?php

namespace App\Http\Requests\Admin\Guardian\ApplicationFormRequests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class IndexRequest extends BaseRequest
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
            'guardian_id' => 'required | integer',
            'updated_at_lower_limit' => 'nullable | date',
            'updated_at_upper_limit' => 'nullable | date',
            'id' => 'nullable',
            'status' => 'nullable | integer',
            'subject' => 'nullable'
        ];
    }
}
