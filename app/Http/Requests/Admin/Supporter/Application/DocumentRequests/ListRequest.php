<?php

namespace App\Http\Requests\Admin\Supporter\Application\DocumentRequests;


use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class ListRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
        ];
    }

    public function rules()
    {
        return [
            'page' => 'integer',
            'request_at_from' => 'nullable | date',
            'request_at_to' => 'nullable | date',
            //現時点でfile_idが何なのか曖昧なためコメントアウト
            // 'file_id' => 'nullable | integer',
            'status' => 'nullable | integer',
            'category' => 'nullable | integer',
            'expiration_on' => 'nullable | date',
        ];
    }
}
