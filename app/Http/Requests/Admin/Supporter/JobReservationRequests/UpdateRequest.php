<?php

namespace App\Http\Requests\Admin\Supporter\JobReservationRequests;

use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends CustomFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            "start_at" => "date",
            "end_at" => "date|after_or_equal:start_at",
            "supporter_user_id" => 'integer',
            "guardian_user_id" => 'integer',
            "regular_or_single_flag" => Rule::in([0, 1]),
            "contents_type" => Rule::in([0, 1]),
            "is_watch_over" => Rule::in([0, 1]),
            "reservation_status" => Rule::in([0, 1])
        ];
    }
}
