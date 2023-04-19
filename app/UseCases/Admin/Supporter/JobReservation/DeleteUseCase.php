<?php

namespace App\UseCases\Admin\Supporter\JobReservation;

use App\Models\JobReservation;

class DeleteUseCase
{
    public function __invoke($supporter_user_id)
    {
        return JobReservation::where("supporter_user_id", $supporter_user_id)->delete();
    }
}
