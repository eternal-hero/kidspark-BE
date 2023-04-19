<?php

namespace App\Http\Requests\Supporter\Application\DocumentRequests;

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
            'supporter_user_id' => 'integer',
            'file_id' => 'integer',
            'status' => 'integer',
            'memo' => 'string',
            'category' => 'integer',
            'application_type' => 'integer',
            'application_name' => 'nullable|string',
            'application_at' => 'date_format:Y-m-d H:i:s',
            'expiration_on' => 'date',
            'file_path' => 'string'
        ];
    }
}
