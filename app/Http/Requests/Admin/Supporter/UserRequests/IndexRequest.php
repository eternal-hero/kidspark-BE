<?php

namespace App\Http\Requests\Admin\Supporter\UserRequests;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

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
            'supporter' => 'nullable | string',
            'work_record' => 'nullable | integer',
            'gender' => ['nullable', Rule::in([0, 1])],
            'prefecture' => 'nullable|max:255',
            'status' => ['nullable', Rule::in([0, 1, 2, 3])],
            'is_supporter' => ['nullable', Rule::in([0, 1, 2, 3, 4, 5, 6])],
            'is_childbirth_care' => ['nullable', Rule::in([0, 1, 2, 3, 4, 5, 6])],
            'is_sick_child_care' => ['nullable', Rule::in([0, 1, 2, 3, 4, 5, 6])],
            'is_housework' => ['nullable', Rule::in([0, 1, 2, 3, 4, 5, 6])],
        ];
    }
}
