<?php

namespace App\UseCases\Admin\Supporter\Setting;

use App\Models\SupporterSetting;
use App\Models\SupporterSettingsManagement;

class StoreUseCase
{
    public function __invoke(array $data)
    {
        $data['settings_id'] =
            SupporterSettingsManagement::where('name',config('api.supporter.supporter_setting_type.supporter'))->first()->id;

        return SupporterSetting::create($data);
    }
}
