<?php

namespace App\UseCases\Supporter\ChildbirthCare\Setting;

use App\Models\ChildbirthCareSetting;

class DeleteUseCase
{
    public function __invoke($supporter_user_id)
    {
        ChildbirthCareSetting::where('supporter_user_id', $supporter_user_id)->delete();
    }
}
