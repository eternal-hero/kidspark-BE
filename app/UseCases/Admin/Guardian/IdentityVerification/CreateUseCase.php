<?php
namespace App\UseCases\Admin\Guardian\IdentityVerification;

use App\Models\IdentityVerification;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return IdentityVerification::create($data);
    }
}