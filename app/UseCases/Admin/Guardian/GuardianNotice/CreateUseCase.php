<?php
namespace App\UseCases\Admin\Guardian\GuardianNotice;

use App\Models\GuardianNotice;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return GuardianNotice::create($data);
    }
}