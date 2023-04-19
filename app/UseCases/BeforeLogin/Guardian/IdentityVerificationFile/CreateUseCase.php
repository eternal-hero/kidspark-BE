<?php
namespace App\UseCases\BeforeLogin\Guardian\IdentityVerificationFile;

use App\Models\IdentityVerificationFile;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return IdentityVerificationFile::create($data);
    }
}
