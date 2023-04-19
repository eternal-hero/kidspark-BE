<?php

namespace App\UseCases\Supporter\ChildbirthCare\Support;

use App\Models\ChildbirthCareSupport;

class CreateUseCase
{
    public function __invoke($data)
    {
        return ChildbirthCareSupport::create($data);
    }
}
