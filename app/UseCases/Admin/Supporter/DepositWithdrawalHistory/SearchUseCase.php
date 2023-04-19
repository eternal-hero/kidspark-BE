<?php

namespace App\UseCases\Admin\Supporter\DepositWithdrawalHistory;


use App\Models\DepositWithdrawalHistory;

class SearchUseCase
{
    public function __invoke($data)
    {
        if (!array_key_exists('deposit_withdrawal_id',$data)) {
            $query = DepositWithdrawalHistory::where('supporter_user_id', $data['supporter_user_id']);
            if(array_key_exists('date',$data)){
                $month = $data['date'];
                $query = $query->where('date_on','>=',date('Y-m-d',strtotime('first day of '. $month)))
                ->where('date_on','<=',date('Y-m-d',strtotime('last day of '. $month)));
            }
            return $query->get();
        }else{
            $query = DepositWithdrawalHistory::find($data['deposit_withdrawal_id']);
            return $query;
        }
    }
}
