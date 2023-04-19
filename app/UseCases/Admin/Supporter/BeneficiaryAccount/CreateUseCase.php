<?php

namespace App\UseCases\Admin\Supporter\BeneficiaryAccount;

use App\Models\BeneficiaryAccount;


class CreateUseCase
{
    public function __invoke($data)
    {
        return BeneficiaryAccount::create($data);
    }
}
