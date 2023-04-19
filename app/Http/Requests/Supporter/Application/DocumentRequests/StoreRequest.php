<?php

namespace App\Http\Requests\Supporter\Application\DocumentRequests;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file_id' => 'string',
            'status' => 'integer',
            'category' => 'integer',
            'application_type' => 'integer',
            'application_name' => 'nullable|string',
            'application_at' => 'date_format:Y-m-d H:i:s',
            'expiration_on' => 'date',
            'file_path' => 'string'
        ];
    }
}
