<?php

namespace App\Http\Requests\Supporter\EstimateRequests;

use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends CustomFormRequest
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
            
            'basic_fee' => 'required|integer',
            
            'option' => 'nullable|array',
            'option.fee' => 'required_with:option|integer',
            'option.detail' => 'nullable|string',
            
            'transportation' => 'nullable|array',
            'transportation.fee' => 'required_with:transportation|integer',
            'transportation.detail' => 'nullable|string',
            
            'discount' => 'nullable|array',
            'discount.fee' => 'required_with:discount|integer',
            'discount.detail' => 'nullable|string',

            'commission_fee' => 'required|integer'
        ];
    }
}
