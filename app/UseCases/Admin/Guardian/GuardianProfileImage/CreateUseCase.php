<?php
namespace App\UseCases\Admin\Guardian\GuardianProfileImage;

use App\Models\GuardianProfileImage;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return GuardianProfileImage::create($data);
    }
}