<?php

namespace App\UseCases\Supporter\SickChildCare\Support;

use App\Models\SickChildCareSupport;

class CreateUseCase
{
    public function __invoke($data)
    {
        return SickChildCareSupport::create($data);
    }
}
