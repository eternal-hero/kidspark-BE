<?php

namespace App\UseCases\Admin\Common\InoculationStatus;

use App\Models\InoculationStatus;

class CreateUseCase
{
    public function __invoke($requestData)
    {
        $inoculation = new InoculationStatus();
        $inoculation->fill($requestData);
        $inoculation->save();
        return $inoculation;
    }
}
