<?php

namespace App\UseCases\Admin\Common\InoculationStatus;

use App\Models\InoculationStatus;

class SearchUseCase
{
    public function __invoke($id)
    {
        if (is_null($id)) {
            return InoculationStatus::all();
        }
        $inoculation = InoculationStatus::find($id);
        if (is_null($inoculation)) {
            abort(404, "Inoculation not found");
        }
        return $inoculation;
    }
}
