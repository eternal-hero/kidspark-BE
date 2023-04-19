<?php

namespace App\Http\Requests\Supporter\ScheduleRequests;

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
            'working_date' => 'required|date_format:Y-m-d',
            'start_at' => 'required_if:is_available_all_day,1|date_format:H:i',
            'end_at' => 'required_if:is_available_all_day,1|date_format:H:i',
            'is_available_all_day' => ['required', Rule::in([0, 1])],
        ];
    }
}
