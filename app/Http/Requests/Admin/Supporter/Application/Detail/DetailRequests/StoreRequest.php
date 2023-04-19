<?php

namespace App\Http\Requests\Admin\Supporter\Application\Detail\DetailRequests;

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
            "status" => 'required|integer',
            "memo" => 'required|string',
            "subject" => 'required|integer',
            "sender" => 'required|string',
            "member_id" => 'required|string',
            "detail" => 'required|string',
            "file_path" => 'required|string'
        ];
    }
}
