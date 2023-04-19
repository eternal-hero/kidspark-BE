<?php

namespace App\UseCases\Admin\Supporter\PreInterviewSetting;

use App\Models\PreInterviewSetting;


class UpdateUseCase
{
    public function __invoke($supporter_user_id, array $data)
    {
        return PreInterviewSetting::where('supporter_user_id', $supporter_user_id)->update($data);
    }
}
