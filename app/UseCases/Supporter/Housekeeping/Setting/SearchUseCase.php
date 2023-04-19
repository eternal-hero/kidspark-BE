<?php
namespace App\UseCases\Supporter\Housekeeping\Setting;

use App\Models\HousekeepingSetting;


class SearchUseCase
{
    public function __invoke($supporter_user_id = null)
    {
        if(!is_null($supporter_user_id)){
            $housekeeping_setting = HousekeepingSetting::where('supporter_user_id',$supporter_user_id);
            return $housekeeping_setting->first();
        }
        return HousekeepingSetting::all();
    }
}
