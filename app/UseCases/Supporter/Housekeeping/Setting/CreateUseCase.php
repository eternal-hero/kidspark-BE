<?php
namespace App\UseCases\Supporter\Housekeeping\Setting;

use App\Models\HousekeepingSetting;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return HousekeepingSetting::create($data);
    }
}