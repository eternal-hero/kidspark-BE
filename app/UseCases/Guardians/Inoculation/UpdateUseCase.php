<?php

namespace App\UseCases\Guardians\Inoculation;

use App\Models\InoculationStatus;


class UpdateUseCase
{
    public function __invoke($inoculation_status_id, $data)
    {
        return InoculationStatus::where('id', $inoculation_status_id)->update($data);
    }
}
