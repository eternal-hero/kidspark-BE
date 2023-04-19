<?php

namespace App\UseCases\Admin\Supporter\SupportArea;

use App\Models\SupportArea;

class UpdateUseCase
{
    public function __invoke($requestData, $supporter_user_id, $support_area_id)
    {
        $supportArea = (new SearchUseCase)($supporter_user_id, $support_area_id);
        $supportArea->fill($requestData);
        $supportArea->save();
        return $supportArea;
    }
}
