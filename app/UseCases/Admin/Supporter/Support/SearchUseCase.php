<?php

namespace App\UseCases\Admin\Supporter\Support;

use App\Models\SupporterSupport;

class SearchUseCase
{
    public function __invoke($supporter_user_id)
    {
        return SupporterSupport::where('supporter_user_id', $supporter_user_id)->first();
    }
}
