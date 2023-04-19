<?php

namespace App\UseCases\Supporter\Setting;

use App\Models\SupporterSetting;

class DeleteUseCase
{
    public function __invoke($supporter_user_id)
    {
        SupporterSetting::where('supporter_user_id', $supporter_user_id)->delete();
    }
}
