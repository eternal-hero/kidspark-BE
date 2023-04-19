<?php

namespace App\Http\Requests\Admin\Supporter\SupportAreaRequests;

use App\Http\Requests\CustomFormRequest;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'supporter_user_id' => 'required|integer',
            'prefecture' => 'required|integer',
            'area' => 'required|integer'
        ];
    }
}
