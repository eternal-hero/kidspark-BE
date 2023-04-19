<?php

namespace App\UseCases\Admin\Supporter\SickChildCare\Support;

use App\Models\SickChildCareSupport;

class DeleteUseCase
{
    public function __invoke($supporter_user_id)
    {
        return SickChildCareSupport::where('supporter_user_id', $supporter_user_id)->delete();
    }
}
