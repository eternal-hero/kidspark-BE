<?php

namespace App\UseCases\Admin\Supporter\Profile;

use App\Models\SupporterProfile;

class UpdateUseCase
{
    public function __invoke($requestData, $supporter_user_id)
    {
        $supporterProfile = SupporterProfile::firstWhere("supporter_user_id", $supporter_user_id);
        if (is_null($supporterProfile)) {
            abort(404, "Supporter profile not found");
        }
        $supporterProfile->fill($requestData);
        $supporterProfile->save();
        return $supporterProfile;
    }
}
