<?php

namespace App\UseCases\Supporter\WorkImage;

use App\Models\SupporterWorksImage;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return SupporterWorksImage::create($data);
    }
}
