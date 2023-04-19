<?php

namespace App\UseCases\Guardians\User;

use App\Models\GuardianUser;


class UpdateUseCase
{
    public function __invoke($id, array $data)
    {
        return GuardianUser::where('id', $id)->update($data);
    }
}
