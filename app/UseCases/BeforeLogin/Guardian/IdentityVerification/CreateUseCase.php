<?php
namespace App\UseCases\BeforeLogin\Guardian\IdentityVerification;

use App\Models\IdentityVerification;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return IdentityVerification::create($data);
    }
}
