<?php

namespace App\UseCases\Admin\Supporter\ChildbirthCare\Support;

use App\Models\ChildbirthCareSupport;

class CreateUseCase
{
    public function __invoke($data)
    {
        return ChildbirthCareSupport::create($data);
    }
}
