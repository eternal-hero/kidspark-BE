<?php
namespace App\UseCases\Admin\Guardian\User;

use App\Models\GuardianUser;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return GuardianUser::create($data);
    }
}