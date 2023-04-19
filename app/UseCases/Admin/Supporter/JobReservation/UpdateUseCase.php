<?php

namespace App\UseCases\Admin\Supporter\JobReservation;

use App\Models\JobReservation;

class UpdateUseCase
{
    public function __invoke($requestData, $supporter_user_id)
    {
        $jobReservation = JobReservation::firstWhere("supporter_user_id", $supporter_user_id);
        if (is_null($jobReservation)) {
            abort(404, "Job reservation not found");
        }
        $jobReservation->fill($requestData);
        $jobReservation->save();
        return $jobReservation;
    }
}
