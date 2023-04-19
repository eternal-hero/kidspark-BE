<?php

namespace App\Http\Requests\Admin\Supporter\Application\DocumentRequests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

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
            'application_document_id' => 'nullable|integer',
            'file_id' => 'nullable|string',
            'status' => 'nullable|integer',
            'category' => 'nullable|integer',
            'application_at_lower_limit' => 'nullable|date',
            'application_at_upper_limit' => 'nullable|date',
            'expiration_on' => 'nullable|date',
        ];
    }
}
