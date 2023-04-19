<?php

namespace App\UseCases\Admin\Common\InoculationStatus;


class DeleteUseCase
{
    public function __invoke($id)
    {
        $inoculation = (new SearchUseCase)($id);
        $inoculation->delete();
    }
}
