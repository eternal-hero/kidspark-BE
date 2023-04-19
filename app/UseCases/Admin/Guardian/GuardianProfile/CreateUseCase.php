<?php
namespace App\UseCases\Admin\Guardian\GuardianProfile;

use App\Models\GuardianProfile;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return GuardianProfile::create($data);
    }
}