<?php

namespace App\Http\Requests\Admin\Supporter\ChildbirthCare\SupportRequests;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class StoreRequest extends BaseRequest
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
            'settings_id' => 'required | inside_settings_id',
            'supporter_user_id' => 'required | integer',
            'acceptance_condition' => 'nullable | string',
            'supported_service' => 'nullable | string',
        ];
    }
}
