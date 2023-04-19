<?php

namespace App\UseCases\Supporter\Setting;

use App\Models\SupporterSetting;

class SearchUseCase
{
    public function __invoke($supporter_user_id)
    {
        $setting = SupporterSetting::where('supporter_user_id', $supporter_user_id)
            ->first();
        // if (is_null($setting)) {
        //     abort(404, "Supporter setting not found");
        // }
        return $setting;
    }
}
