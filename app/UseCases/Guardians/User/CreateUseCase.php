<?php
namespace App\UseCases\Guardians\User;

use App\Models\GuardianUser;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return GuardianUser::create($data);
    }
}