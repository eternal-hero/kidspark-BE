<?php

namespace App\Http\Requests\Admin\Supporter\Result\ReviewRequests;


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
            'job_id' => 'お仕事ID',
            'support_at' => '仕事の開始日',
            'settlement_at' => '決済日表示',
            "content_type" => '仕事内容の種類',
            'amount_total' => '内訳の合計',
        ];
    }

    public function rules()
    {
        return [
            'job_id' => 'required',
            'support_at' => 'required | date',
            'settlement_at' => 'required | date',
            "content_type" => 'required',
            'amount_total' => 'required | integer',
        ];
    }
}
