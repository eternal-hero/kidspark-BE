<?php

namespace App\UseCases\Admin\Supporter\ChildbirthCare\Support;

use App\Models\ChildbirthCareSupport;

class SearchUseCase
{
    public function __invoke($supporter_user_id)
    {
        return ChildbirthCareSupport::where('supporter_user_id', $supporter_user_id)->first();
    }
}
