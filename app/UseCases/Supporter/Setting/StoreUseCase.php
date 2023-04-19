<?php

namespace App\UseCases\Supporter\Setting;

use App\Models\SupporterSetting;

class StoreUseCase
{
    public function __invoke(array $data)
    {
        return SupporterSetting::create($data);
    }
}
