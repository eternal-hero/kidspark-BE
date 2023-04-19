<?php

namespace App\UseCases\Supporter\SickChildCare\Support;

use App\Models\SickChildCareSupport;

class UpdateUseCase
{
    public function __invoke($requestData, $supporter_user_id)
    {
        return SickChildCareSupport::where('supporter_user_id', $supporter_user_id)->update($data);
    }
}
