<?php

namespace App\UseCases\Supporter\SickChildCare\Setting;

use App\Models\SickChildCareSetting;

class StoreUseCase
{
    public function __invoke(array $data)
    {
        return SickChildCareSetting::create($data);
    }
}
