<?php

namespace App\UseCases\Admin\Supporter\User;

use App\Models\SupporterUser;

class StoreUseCase
{
    public function __invoke($data)
    {
        return SupporterUser::create($data);
    }
}
