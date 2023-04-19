<?php

namespace App\UseCases\Admin\Supporter\PreInterviewSetting;

use App\Models\PreInterviewSetting;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return PreInterviewSetting::create($data);
    }
}
