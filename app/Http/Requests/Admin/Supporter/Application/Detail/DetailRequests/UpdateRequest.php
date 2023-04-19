<?php

namespace App\Http\Requests\Admin\Supporter\Application\Detail\DetailRequests;

use App\Http\Requests\CustomFormRequest;

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
            "status" => 'integer',
            "memo" => 'string',
            "subject" => 'integer',
            "sender" => 'string',
            "member_id" => 'string',
            "detail" => 'string',
            "file_path" => 'string'
        ];
    }
}
