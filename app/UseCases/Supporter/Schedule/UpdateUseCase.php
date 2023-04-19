<?php

namespace App\UseCases\Supporter\Schedule;

use App\Models\SupporterSchedule;

class UpdateUseCase
{
    public function __invoke($request, $schedule_id)
    {
        $schedule = SupporterSchedule::where('id',$schedule_id)->first();
        $data = [
            'working_date' => $request->working_date,
            'is_available_all_day' => $request->is_available_all_day,
            'is_reservable' => 0
        ];
        if ($request->is_available_all_day == 1) {
            $data['start_at'] = $request->start_at;
            $data['end_at'] = $request->end_at;
            $data['is_reservable'] = 1;
        }
        $schedule->fill($data)->save();
    }
}
