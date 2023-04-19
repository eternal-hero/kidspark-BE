<?php

namespace App\UseCases\Supporter\SupportArea;

use App\Models\SupportArea;

class StoreUseCase
{
    public function __invoke($requestData, $supporter_user_id)
    {
        $supportArea = new SupportArea();
        $supportArea->fill($requestData);
        $supportArea->supporter_user_id = $supporter_user_id;
        $supportArea->save();
        return $supportArea;
    }
}
