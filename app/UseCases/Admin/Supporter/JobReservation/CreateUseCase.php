<?php

namespace App\UseCases\Admin\Supporter\JobReservation;

use App\Models\JobReservation;
use Carbon\Carbon;

class CreateUseCase
{
    public function __invoke($requestData)
    {
        $beneficiaryAccount = new JobReservation();
        $beneficiaryAccount->fill($requestData);
        $beneficiaryAccount->save();
        return $beneficiaryAccount;
    }
}
