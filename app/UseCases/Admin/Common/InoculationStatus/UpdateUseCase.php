<?php

namespace App\UseCases\Admin\Common\InoculationStatus;

class UpdateUseCase
{
    public function __invoke($requestData, $id)
    {
        $inoculation = (new SearchUseCase)($id);
        $inoculation->fill($requestData);
        $inoculation->save();
        return $inoculation;
    }
}
