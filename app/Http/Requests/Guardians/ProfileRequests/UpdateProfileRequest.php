<?php

namespace App\Http\Requests\Guardians\ProfileRequests;


use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'self_introduction' => '自己紹介文',
            'near_line' => '最寄り路線',
            'near_station' => '最寄り駅',
            'means' => '最寄り駅までの移動手段',
            'travel_time' => '最寄り駅までの所要時間',
            'is_publish' => '最寄り駅の公開',
            'way_to_get_home' => '家に帰る方法',
        ];
    }

    public function rules()
    {
        return [
            'inoculation_status_id' => 'integer|nullable',
            'self_introduction' => 'required',
            'near_line' => 'required',
            'near_station' => 'required',
            'means' => 'required | integer',
            'travel_time' => 'required | integer',
            'is_publish' => 'required | integer',
            'way_to_get_home' => 'string|nullable',
            'rule' => 'nullable|string'
        ];
    }
}
