<?php
namespace App\UseCases\BeforeLogin\Guardian\TmpGuardianUser;

use App\Models\TmpGuardianUser;


class CreateUseCase
{
    public function __invoke(array $data)
    {

        return TmpGuardianUser::create($data);
    }
}
