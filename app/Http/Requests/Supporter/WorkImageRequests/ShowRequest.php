<?php

namespace App\Http\Requests\Supporter\WorkImageRequests;


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

    public function attributes(){
        return [
            'supporter_user_id' => 'パークサポーターID',
            'works_image_id' => 'ファイルID',
        ];
    }

    public function rules()
    {
        return [
            'supporter_user_id' => 'required | integer',
            'works_image_id' => 'nullable | integer',
        ];
    }
}
