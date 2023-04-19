<?php

namespace App\UseCases\Supporter\ChildbirthCare\Setting;

use App\Models\ChildbirthCareSetting;
use Illuminate\Support\Facades\DB;
class SearchUseCase
{
    public function __invoke($supporter_user_id)
    {
        $setting = ChildbirthCareSetting::where('supporter_user_id', $supporter_user_id)
            ->first();
        // if (is_null($setting)) {
        //     abort(404, "Supporter setting not found");
        // }
        return $setting;
    }
}
