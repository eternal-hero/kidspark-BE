<?php

namespace App\Http\Requests\Guardians\ProfileRequests;


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
            'inoculation_status_id' => 'ワクチン接種状況テーブルID',
            'title' => 'タイトル',
            'self_introduction' => '自己紹介文',
            'near_line' => '最寄り路線',
            'near_station' => '最寄り駅',
            'means' => '最寄り駅までの移動手段',
            'travel_time' => '最寄り駅までの所要時間',
            'is_publish' => '最寄り駅の公開',
            'rule' => 'ご家庭のルール'
        ];
    }

    public function rules()
    {
        return [
            'inoculation_status_id' => 'required | integer',
            'title' => 'required',
            'self_introduction' => 'required',
            'near_line' => 'required',
            'near_station' => 'required',
            'means' => 'required | integer',
            'travel_time' => 'required | integer',
            'is_publish' => 'required | integer',
            'rule' => 'nullable'
        ];
    }
}