<?php

namespace App\UseCases\Supporter\PreInterviewSetting;

use App\Models\PreInterviewSetting;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return PreInterviewSetting::create($data);
    }
}
