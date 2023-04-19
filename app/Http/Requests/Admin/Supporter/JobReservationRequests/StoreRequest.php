<?php

namespace App\Http\Requests\Admin\Supporter\JobReservationRequests;

use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends CustomFormRequest
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
            "start_at" => "required|date",
            "end_at" => "date|after_or_equal:start_at",
            "supporter_user_id" => 'required|integer',
            "guardian_user_id" => 'required|integer',
            "regular_or_single_flag" => ['required', Rule::in([0, 1])],
            "contents_type" => ['required', Rule::in([0, 1])],
            "is_watch_over" => ['required', Rule::in([0, 1])],
            "reservation_status" => ['required', Rule::in([0, 1])]
        ];
    }
}
