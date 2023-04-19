<?php

namespace App\UseCases\Admin\Supporter\Option;

use App\Models\SupporterOption;

class StoreUseCase
{
    public function __invoke($data)
    {
        return SupporterOption::create($data);
    }

}
