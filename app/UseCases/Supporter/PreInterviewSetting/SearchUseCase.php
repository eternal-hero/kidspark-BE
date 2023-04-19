<?php

namespace App\UseCases\Supporter\PreInterviewSetting;

use App\Models\PreInterviewSetting;


class SearchUseCase
{
    public function __invoke($supporter_user_id)
    {
        if (!is_null($supporter_user_id)) {
            return PreInterviewSetting::where('supporter_user_id', $supporter_user_id)->first();
        } else {
            return PreInterviewSetting::all();
        }
    }
}
