<?php

namespace App\Http\Requests\Supporter\ReportRequests;

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
            'support_start_at' => 'required|date_format:Y-m-d H:i',
            'support_end_at' => 'required|date_format:Y-m-d H:i',

            'option' => 'nullable|array',
            'option.fee' => 'required_with:option|integer',
            'option.detail' => 'nullable|string',
            
            'transportation' => 'nullable|array',
            'transportation.fee' => 'required_with:transportation|integer',
            'transportation.detail' => 'nullable|string',
            
            'time_table' => 'required|string',
            'child_appearance' => 'required|string',
            'picture' => 'nullable|string', // "/api/supporter/file/completion_report_contents/upload"の返り値を保存する
            'message' => 'nullable|string',

            'review' => 'required|array',
            'review.icon' => 'required|integer',
            'review.rating' => 'required|integer',
            'review.review_content' => 'nullable|string',
            'review.is_publish' => 'required|boolean',
        ];
    }
}
