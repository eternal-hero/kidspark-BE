<?php

namespace App\Http\Requests\Admin\Supporter\Profile;

use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'title' => 'string',
            'self_introduction' => 'string',
            'near_line' => 'nullable|string|max:255',
            'near_station' => 'nullable|string|max:255',
            'means' => ['nullable',Rule::in([0, 1, 2, 3, 4])],
            'travel_times' => 'nullable|integer',
            'is_publish' => ['nullable',Rule::in([0, 1])],
            'time_between_appointment' => 'nullable|integer',
            'minimum_request_time' => 'nullable|integer',
            'reply_time' => 'nullable|integer',
            'is_foreign_langage' => ['nullable',Rule::in([0, 1])],
        ];
    }
}
