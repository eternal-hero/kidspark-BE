<?php
namespace App\UseCases\Admin\Supporter\Housekeeping\Setting;

use App\Models\HousekeepingSetting;


class UpdateUseCase
{
    public function __invoke($supporter_user_id,array $data)
    {
        return HousekeepingSetting::where('supporter_user_id',$supporter_user_id)->update($data);
    }
}