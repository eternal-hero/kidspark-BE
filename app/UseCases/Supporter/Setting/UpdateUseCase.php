<?php

namespace App\UseCases\Supporter\Setting;

use App\Models\SupporterSetting;

class UpdateUseCase
{
    public function __invoke($supporter_user_id, array $data)
    {
        return SupporterSetting::where('supporter_user_id', $supporter_user_id)->update($data);
    }
}
