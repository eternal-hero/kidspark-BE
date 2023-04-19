<?php

namespace App\Http\Requests\Supporter\Setting\SupportRequests;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shooting_support' => Rule::in([0, 1]),
            'acceptance_condition' => 'string',
            'transportation_support' => Rule::in([0, 1]),
            'early_response_lower_limit' => 'required_unless:early_response_upper_limit,null',
            'early_response_upper_limit' => 'required_unless:early_response_lower_limit,null',
            'nighttime_lower_limit' => 'required_unless:nighttime_upper_limit,null',
            'nighttime_upper_limit' => 'required_unless:nighttime_lower_limit,null',
            'overnight_care_lower_limit' => 'required_unless:overnight_care_upper_limit,null',
            'overnight_care_upper_limit' => 'required_unless:overnight_care_lower_limit,null',
            'is_foreign_user_support' => Rule::in([0, 1]),
            'is_sick_children_support' => Rule::in([0, 1]),
            'is_handicapped_children_support' => Rule::in([0, 1]),
            'lesson_support_bitflag' => 'between:0,7',
            'is_cabinet_office_discount_coupon' => Rule::in([0, 1]),
        ];
    }
}
