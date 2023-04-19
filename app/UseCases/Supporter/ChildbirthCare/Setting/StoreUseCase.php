<?php

namespace App\UseCases\Supporter\ChildbirthCare\Setting;

use App\Models\ChildbirthCareSetting;

class StoreUseCase
{
    public function __invoke(array $data)
    {
        return ChildbirthCareSetting::create($data);
    }
}
