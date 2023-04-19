<?php

namespace App\UseCases\Admin\Supporter\ProfileImage;

use App\Models\SupporterProfileImage;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return SupporterProfileImage::create($data);
    }
}
