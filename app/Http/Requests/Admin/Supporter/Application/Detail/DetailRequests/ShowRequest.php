<?php

namespace App\Http\Requests\Admin\Supporter\Application\Detail\DetailRequests;

use App\Http\Requests\BaseRequest;


class ShowRequest extends BaseRequest
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
            'application_detail_id' => 'nullable|integer',
            'update_at_lower_limit' => 'nullable|date',
            'update_at_upper_limit' => 'nullable|date',
            'status' => 'nullable|integer',
            'subject' => 'nullable|string'
        ];
    }
}
