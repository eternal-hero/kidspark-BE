<?php
namespace App\UseCases\Admin\Supporter\Housekeeping\Support;

use App\Models\HousekeepingSupport;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return HousekeepingSupport::create($data);
    }
}