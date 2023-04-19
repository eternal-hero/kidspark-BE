<?php
namespace App\UseCases\Supporter\Housekeeping\Support;

use App\Models\HousekeepingSupport;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return HousekeepingSupport::create($data);
    }
}