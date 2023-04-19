<?php
namespace App\UseCases\Guardians\Inoculation;

use App\Models\InoculationStatus;


class DeleteUseCase
{
    public function __invoke($id)
    {
        return InoculationStatus::where('id',$id)->delete();
    }
}