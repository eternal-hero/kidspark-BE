<?php

namespace App\UseCases\Admin\Supporter\DepositWithdrawalHistory;


use App\Models\DepositWithdrawalHistory;

class CreateUseCase
{
    public function __invoke($requestData)
    {
        $dwh = new DepositWithdrawalHistory();
        $dwh->fill($requestData);
        $dwh->save();
        return $dwh;
    }
}
