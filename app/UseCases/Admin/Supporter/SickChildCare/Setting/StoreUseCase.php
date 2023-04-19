<?php

namespace App\UseCases\Admin\Supporter\SickChildCare\Setting;

use App\Models\SickChildCareSetting;
use App\Models\SupporterSettingsManagement;

class StoreUseCase
{
    public function __invoke(array $data)
    {
        $data['settings_id'] =
            SupporterSettingsManagement::where('name',config('api.supporter.supporter_setting_type.sick_child_care'))->first()->id;
        return SickChildCareSetting::create($data);
    }
}
