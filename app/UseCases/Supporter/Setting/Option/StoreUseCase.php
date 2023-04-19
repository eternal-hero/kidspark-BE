<?php

namespace App\UseCases\Supporter\Setting\Option;

use App\Models\SupporterOption;

class StoreUseCase
{
    public function __invoke($data)
    {
        return SupporterOption::create($data);
    }

}
