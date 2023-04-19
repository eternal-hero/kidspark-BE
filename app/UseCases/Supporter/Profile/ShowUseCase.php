<?php

namespace App\UseCases\Supporter\Profile;

use App\Models\SupporterProfile;


class ShowUseCase
{
    public function __invoke($supporter_user_id)
    {
        return SupporterProfile::where('supporter_user_id', $supporter_user_id)->get();
    }
}
