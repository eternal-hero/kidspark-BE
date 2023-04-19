<?php

namespace App\UseCases\Supporter\SickChildCare\Setting;

use App\Models\SickChildCareSetting;

class UpdateUseCase
{
    public function __invoke(array $data, $supporter_user_id)
    {
        return SickChildCareSetting::where('supporter_user_id', $supporter_user_id)->update($data);
    }
}
