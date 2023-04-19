<?php

namespace App\UseCases\Admin\Supporter\Profile;

use App\Models\SupporterProfile;


class ShowUseCase
{
    public function __invoke($supporter_user_id)
    {
        $suppoorterUser = SupporterProfile::where('supporter_user_id', $supporter_user_id)->first();
        if (is_null($suppoorterUser)) {
            abort(404, "suppoorterUser not found");
        }
        return $suppoorterUser;

    }
}
