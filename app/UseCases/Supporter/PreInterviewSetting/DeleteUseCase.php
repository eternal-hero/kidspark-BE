<?php

namespace App\UseCases\Supporter\PreInterviewSetting;

use App\Models\PreInterviewSetting;


class DeleteUseCase
{
    public function __invoke($supporter_user_id)
    {
        return PreInterviewSetting::where('supporter_user_id', $supporter_user_id)->delete();
    }
}
