<?php
namespace App\UseCases\Admin\Guardian\ApplicationForm;

use App\Models\ApplicationForm;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return ApplicationForm::create($data);
    }
}