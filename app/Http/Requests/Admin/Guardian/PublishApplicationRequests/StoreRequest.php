<?php

namespace App\Http\Requests\Admin\Guardian\PublishApplicationRequests;


use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'guardian_user_id' => '保護者ID',
            'title' => 'タイトル',
            'type' => '内容の種類 (1:シッター, 2:家庭教師, 3:家事代行, 4:産前産後)',
            'is_single' => '定期/単発 (0:単発, 1:定期)',
            'childcare_on' => '預けたい日',
            'support_time_start' => 'サポート開始時間',
            'support_time_end' => 'サポート終了時間',
            'detail' => '仕事内容詳細',
            'fee_limit' => '時給上限',
            'transportation_expenses_limit' => '交通費上限',
            'place' => 'サポート場所（市町村）',
            'near_station' => '最寄り駅',
            'period_at' => '募集期限',
            'status' => 'ステータス (-1: キャンセル, 0:募集終了, 1:募集中)'
        ];
    }

    public function rules()
    {
        return [
            'guardian_user_id' => 'required  | integer',
            'title' => 'required',
            'type' => 'required  | integer',
            'is_single' => 'required | boolean',
            'childcare_on' => 'required | date',
            'support_time_start' => 'required | date_format:H:i',
            'support_time_end' => 'required | date_format:H:i',
            'detail' => 'required',
            'fee_limit' => 'required  | integer',
            'transportation_expenses_limit' => 'required  | integer',
            'place' => 'required',
            'near_station' => 'required',
            'period_at' => 'required | date',
            'status' => 'required  | integer'
        ];
    }
}
