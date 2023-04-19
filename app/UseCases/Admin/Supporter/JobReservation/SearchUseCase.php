<?php

namespace App\UseCases\Admin\Supporter\JobReservation;

use App\Models\JobReservation;

class SearchUseCase
{
    public function __invoke($supporter_user_id = null)
    {
        if (is_null($supporter_user_id)) {
            return JobReservation::all();
        }
        return JobReservation::where('supporter_user_id', $supporter_user_id)->get();
    }
}
