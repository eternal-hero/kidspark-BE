<?php

namespace App\UseCases\Admin\Supporter\BeneficiaryAccount;

use App\Models\BeneficiaryAccount;
use Carbon\Carbon;

class UpdateUseCase
{
    public function __invoke($data, $supporter_user_id)
    {
        $beneficiaryAccount = BeneficiaryAccount::where('supporter_user_id',$supporter_user_id);
        if (is_null($beneficiaryAccount)) {
            abort(404, "Supporter user not found");
        }
        $beneficiaryAccount->update($data);
        return $beneficiaryAccount;
    }
}
