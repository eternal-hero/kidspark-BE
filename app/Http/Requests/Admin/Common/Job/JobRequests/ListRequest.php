<?php

namespace App\Http\Requests\Admin\Common\Job\JobRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListRequest extends FormRequest
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
            "start_at_lower_limit" => "nullable | date",
            "start_at_upper_limit" => "nullable  | date",
            'job_id' => 'nullable | string',
            'status' => 'nullable | inside_job_status',
            'supporter' => 'nullable | string',
            'job_contents' => ['nullable', Rule::in([0, 1, 2])],
            'user' => 'nullable | string',
            'category' => 'nullable | inside_job_category',
            'prefecture' => 'nullable|max:255',
            'monitaring' => ['nullable', Rule::in([0, 1, 2])],
        ];
    }
}
