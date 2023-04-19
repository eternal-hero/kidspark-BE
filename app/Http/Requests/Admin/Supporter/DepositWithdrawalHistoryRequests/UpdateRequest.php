<?php

namespace App\Http\Requests\Admin\Supporter\DepositWithdrawalHistoryRequests;

use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'supporter_user_id' => 'required|integer',
            'date_on' => 'date',
            'content' => 'string',
            'amount' => 'integer',
            'status' => Rule::in([0, 1]),
            'is_deposit_withdrawal' => Rule::in([0, 1])
        ];
    }
}
