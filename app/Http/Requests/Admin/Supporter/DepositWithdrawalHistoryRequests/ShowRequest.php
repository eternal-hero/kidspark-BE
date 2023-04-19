<?php

namespace App\Http\Requests\Admin\Supporter\DepositWithdrawalHistoryRequests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ShowRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'supporter_user_id' => 'required | integer',
            'deposit_withdrawal_id' => 'nullable | integer',
            'date' => 'nullable | date_format:Y-m'
        ];
    }
}
