<?php

namespace App\UseCases\Supporter\Setting\Support;

use App\Models\SupporterSupport;

class CreateUseCase
{
    public function __invoke($data)
    {
        $supporterSupport = new SupporterSupport();
        $supporterSupport->fill($data);
        $supporterSupport->save();
        return $supporterSupport;
    }
}
