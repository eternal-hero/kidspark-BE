<?php

namespace App\UseCases\Admin\Supporter\BeneficiaryAccount;

use App\Models\BeneficiaryAccount;

class DeleteUseCase
{
    public function __invoke($supporter_user_id)
    {
        return BeneficiaryAccount::where("supporter_user_id", $supporter_user_id)->delete();
    }
}
