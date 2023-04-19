<?php
namespace App\UseCases\Admin\Supporter\Housekeeping\Setting;

use App\Models\HousekeepingSetting;
use App\Models\SupporterSettingsManagement;

class CreateUseCase
{
    public function __invoke(array $data)
    {
        $data['settings_id'] =
            SupporterSettingsManagement::where('name',config('api.supporter.supporter_setting_type.housekeeping'))->first()->id;

        return HousekeepingSetting::create($data);
    }
}
