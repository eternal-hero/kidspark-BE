<?php

namespace App\Http\Requests\Admin\Guardian\PointRequests;


use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'job_reservation_id' => 'お仕事ID',
            'content' => '内容',
            'point' => '獲得/利用ポイント',
            'point_on' => 'ポイント付与日'
        ];
    }

    public function rules()
    {
        return [
            'job_reservation_id' => 'nullable',
            'content' => 'required  | integer',
            'point' => 'required  | integer',
            'point_on' => 'required | date'
        ];
    }
}
