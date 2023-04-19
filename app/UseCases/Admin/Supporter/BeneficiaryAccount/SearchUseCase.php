<?php

namespace App\UseCases\Admin\Supporter\BeneficiaryAccount;

use App\Models\BeneficiaryAccount;

class SearchUseCase
{
    public function __invoke($supporter_user_id = null)
    {
        if (is_null($supporter_user_id)) {
            return BeneficiaryAccount::all();
        }
        return BeneficiaryAccount::where('supporter_user_id', $supporter_user_id)->get();
    }
}
