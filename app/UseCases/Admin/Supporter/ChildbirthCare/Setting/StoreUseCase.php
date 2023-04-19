<?php

namespace App\UseCases\Admin\Supporter\ChildbirthCare\Setting;

use App\Models\ChildbirthCareSetting;
use App\Models\SupporterSettingsManagement;

class StoreUseCase
{
    public function __invoke(array $data)
    {
        $data['settings_id'] =
            SupporterSettingsManagement::where('name',config('api.supporter.supporter_setting_type.childbirth_care'))->first()->id;

        return ChildbirthCareSetting::create($data);
    }
}
