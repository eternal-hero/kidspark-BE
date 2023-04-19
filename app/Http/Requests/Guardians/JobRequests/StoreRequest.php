<?php

namespace App\Http\Requests\Guardians\JobRequests;


use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
        ];
    }

    public function rules()
    {
        return [
            'supporter_user_id' => 'required|integer',
            'category' => 'required|between:0,3',
            'content_type' => 'required|between:0,3',

            'start_at' => 'required|date_format:Y-m-d H:i',
            'end_at' => 'required|date_format:Y-m-d H:i',

            'is_my_home' => ['required', Rule::in([0, 1])],
            'support_place' => 'required_if:is_my_home,0|array',
            'support_place.address' => 'nullable|string',
            'support_place.near_line' => 'required_with:support_place|string',
            'support_place.near_station' => 'required_with:support_place|string',
            'support_place.means' => Rule::in([0, 1, 2]),
            'support_place.travel_time' => 'required_with:support_place|integer',
            'support_place.way_to_get_home' => 'nullable|string',
            
            'support_place.images' => 'nullable|array',
            'support_place.images.path' => 'required_with:support_place.images|string',

            'children' => 'required|array',
            'children.id' => 'required|integer',
            'options' => 'nullable|array',
            'options.id' => 'required_with:options|integer',
            
            'contents' => 'required|string',

            'estimated_amounts' => 'required|array',
            'estimated_amounts.basic_fee' => 'required|integer',
            'estimated_amounts.option_fee' => 'required|integer',
            'estimated_amounts.transportation_fee' => 'required|integer',
            'estimated_amounts.commission_fee' => 'required|integer',
        ];
    }
}
