<?php

namespace App\UseCases\Guardians\Inoculation;

use App\Models\InoculationStatus;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return InoculationStatus::create($data);
    }
}
