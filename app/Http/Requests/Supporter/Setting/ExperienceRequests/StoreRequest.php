<?php

namespace App\Http\Requests\Supporter\Setting\ExperienceRequests;


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

    public function attributes(){
        return [
            'parenting_experience' => '子育て経験フラグ'
        ];
    }

    public function rules()
    {
        return [
            'parenting_experience' => 'required  | integer'
        ];
    }
}
