<?php

namespace App\UseCases\Guardians\Inoculation;

use App\Models\InoculationStatus;


class SearchUseCase
{
    public function __invoke($guardian_user_id = null, $id = null)
    {
        if (is_null($id)) {
            $value = InoculationStatus::join('guardian_profiles', 'guardian_profiles.inoculation_status_id', '=', 'inoculation_status.id')
                ->join('guardian_users', 'guardian_users.id', '=', 'guardian_profiles.guardian_user_id')
                ->where('guardian_users.id', $guardian_user_id)
                ->get(['inoculation_status.inoculation_times', 'inoculation_status.inoculation_on', 'inoculation_status.is_publish']);
        } else {
            $value = InoculationStatus::where('id', $id)->get();
        }

        if (sizeof($value) == 0) {
            abort(404, "Inoculation not found");
        }
        return $value;
    }
}
