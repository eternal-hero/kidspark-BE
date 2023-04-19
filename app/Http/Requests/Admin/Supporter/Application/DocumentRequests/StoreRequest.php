<?php

namespace App\Http\Requests\Admin\Supporter\Application\DocumentRequests;

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
            'supporter_user_id' => 'required|integer',
            'file_id' => 'required|string',
            'status' => 'required|integer',
            'memo' => 'nullable|string',
            'category' => 'required|integer',
            'application_type' => 'required|integer',
            'application_name' => 'nullable|string',
            'application_at' => 'nullable|date_format:Y-m-d H:i:s',
            'expiration_on' => 'required|date',
            'file_path' => 'required|string'
        ];
    }
}
