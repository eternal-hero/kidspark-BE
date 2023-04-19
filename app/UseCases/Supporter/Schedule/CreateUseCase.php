<?php

namespace App\UseCases\Supporter\Schedule;

use App\Models\SupporterSchedule;

class CreateUseCase
{
    public function __invoke($request, $supporter_user_id)
    {
        $data = [
            'supporter_user_id' => $supporter_user_id,
            'working_date' => $request->working_date,
            'is_available_all_day' => $request->is_available_all_day,
            'is_reservable' => 0
        ];
        if ($request->is_available_all_day == 1) {
            $data['start_at'] = $request->start_at;
            $data['end_at'] = $request->end_at;
            $data['is_reservable'] = 1;
        }
        SupporterSchedule::create($data);
    }
}
