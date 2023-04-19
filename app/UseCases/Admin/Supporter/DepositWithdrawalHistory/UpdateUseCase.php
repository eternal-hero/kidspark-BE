<?php

namespace App\UseCases\Admin\Supporter\DepositWithdrawalHistory;

use App\Models\DepositWithdrawalHistory;

class UpdateUseCase
{
    public function __invoke($requestData, $supporter_user_id, $deposit_withdrawal_id)
    {
        $dwh = DepositWithdrawalHistory::where('supporter_user_id', $supporter_user_id)
            ->where('id', $deposit_withdrawal_id)
            ->first();
        if (is_null($dwh)){
            abort(404, "Deposit withdrawal history not found");
        }
        $dwh->fill($requestData);
        $dwh->save();
        return $dwh;
    }
}
