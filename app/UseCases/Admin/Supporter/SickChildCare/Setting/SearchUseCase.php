<?php

namespace App\UseCases\Admin\Supporter\SickChildCare\Setting;

use App\Models\SickChildCareSetting;

class SearchUseCase
{
    public function __invoke($supporter_user_id)
    {
        $setting = SickChildCareSetting::where('supporter_user_id', $supporter_user_id)
            ->first();
        // if (is_null($setting)) {
        //     abort(404, "Supporter setting not found");
        // }
        return $setting;
    }
}
