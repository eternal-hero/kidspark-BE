<?php

namespace App\UseCases\Admin\Supporter\SickChildCare\Setting;

use App\Models\SickChildCareSetting;

class UpdateUseCase
{
    public function __invoke($supporter_user_id, array $data)
    {
        return SickChildCareSetting::where('supporter_user_id', $supporter_user_id)->update($data);
    }
}
