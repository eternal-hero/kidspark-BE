<?php

namespace App\UseCases\Supporter\SickChildCare\Setting;

use App\Models\SickChildCareSetting;

class DeleteUseCase
{
    public function __invoke($supporter_user_id)
    {
        return SickChildCareSetting::where('supporter_user_id', $supporter_user_id)->delete();
    }
}
