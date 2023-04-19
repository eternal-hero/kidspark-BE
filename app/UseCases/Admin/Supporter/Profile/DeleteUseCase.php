<?php

namespace App\UseCases\Admin\Supporter\Profile;

use App\Models\SupporterProfile;

class DeleteUseCase
{
    public function __invoke($supporter_user_id)
    {
        return SupporterProfile::where("supporter_user_id", $supporter_user_id)->delete();
    }
}
