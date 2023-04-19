<?php

namespace App\Http\Requests\Supporter\MeetingReportRequests;

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
            
            'transportation' => 'nullable|array',
            'transportation.fee' => 'required_with:transportation|integer',
            'transportation.detail' => 'nullable|string',
            
            'meeting_contents' => 'required|string',
            'message' => 'nullable|string',
        ];
    }
}
