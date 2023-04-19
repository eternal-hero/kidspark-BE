<?php

namespace App\UseCases\Supporter\ChildbirthCare\Support;

use App\Models\ChildbirthCareSupport;

class DeleteUseCase
{
    public function __invoke($supporter_user_id)
    {
        return ChildbirthCareSupport::where('supporter_user_id', $supporter_user_id)->delete();
    }
}
