<?php
namespace App\UseCases\Supporter\Housekeeping\Setting;

use App\Models\HousekeepingSetting;


class UpdateUseCase
{
    public function __invoke(array $data, $supporter_user_id)
    {
        return HousekeepingSetting::where('supporter_user_id',$supporter_user_id)->update($data);
    }
}
