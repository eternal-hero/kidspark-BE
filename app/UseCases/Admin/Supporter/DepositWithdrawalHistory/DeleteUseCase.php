<?php

namespace App\UseCases\Admin\Supporter\DepositWithdrawalHistory;

use App\Models\DepositWithdrawalHistory;

class DeleteUseCase
{
    public function __invoke($supporter_user_id, $deposit_withdrawal_id)
    {
        $query = DepositWithdrawalHistory::where('supporter_user_id', $supporter_user_id);
        if (!is_null($deposit_withdrawal_id)) {
            $query = $query->where('id', $deposit_withdrawal_id);
        }
        $query->delete();
    }
}
