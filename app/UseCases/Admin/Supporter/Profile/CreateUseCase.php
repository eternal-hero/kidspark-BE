<?php

namespace App\UseCases\Admin\Supporter\Profile;

use App\Models\SupporterProfile;

class CreateUseCase
{
    public function __invoke($requestData)
    {
        $supporterProfile = SupporterProfile::firstWhere("supporter_user_id", $requestData['supporter_user_id']);
        if (!is_null($supporterProfile)) {
            abort(401, "Supporter profile has already!");
        }

        $beneficiaryAccount = new SupporterProfile();
        $beneficiaryAccount->fill($requestData);
        $beneficiaryAccount->save();

        return $beneficiaryAccount;
    }
}
