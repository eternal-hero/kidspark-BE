<?php

namespace App\Http\Controllers\Supporter;

use App\Http\Requests\Supporter\ScheduleRequests as Schedule;
use App\Http\Controllers\Controller;
use App\Models\SupporterSchedule;
use App\Models\SupporterScheduleAutoRegister;
use App\UseCases\Supporter\Schedule\CreateUseCase;
use App\UseCases\Supporter\Schedule\UpdateUseCase;
use App\UseCases\Supporter\Schedule\UpdateAllUseCase;
use App\UseCases\Supporter\Schedule\AutoUpdateAllUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function store(Schedule\StoreRequest $request)
    {
        $supporter_user_id = Auth::id();
        (new CreateUseCase)($request, $supporter_user_id);
        return response()->ok();
    }
    
    public function index(Request $request)
    {
        $supporter_user_id = Auth::id();
        $first_date = date("Y-m-d", strtotime('first day of ' . $request['month']));
        $last_date = date("Y-m-d", strtotime('last day of ' . $request['month']));
        $schedules = SupporterSchedule::where('supporter_user_id', $supporter_user_id)
            ->whereBetween('working_date',[$first_date,$last_date])->get();
        return response()->ok($schedules);
    }
    
    public function update(Schedule\UpdateRequest $request, $schedule_id)
    {
        (new UpdateUseCase)($request, $schedule_id);
        return response()->ok();
    }

    public function update_all(Request $request)
    {
        $supporter_user_id = Auth::id();
        $post_data = $request->except('supporter_user_id');
        $posts = [];
        foreach($post_data as $key => $data){
            if($data['is_available_all_day'] == 0) { //終日不可
                $posts[] = [
                    'supporter_user_id' => $supporter_user_id,
                    'working_date' => $data['working_date'],
                    'start_at' => NULL,
                    'end_at' => NULL,
                    'is_available_all_day' => $data['is_available_all_day'],
                    'is_reservable' => 0,
                ];
            } else { //予約可
                $posts[] = [
                    'supporter_user_id' => $supporter_user_id,
                    'working_date' => $data['working_date'],
                    'start_at' => $data['start_at'],
                    'end_at' => $data['end_at'],
                    'is_available_all_day' => $data['is_available_all_day'],
                    'is_reservable' => 1,
                ];
            }
        }
        (new UpdateAllUseCase)($posts, $supporter_user_id);
        return response()->ok();
    }

    public function auto_index()
    {
        $supporter_user_id = Auth::id();
        $schedule = SupporterScheduleAutoRegister::where('supporter_user_id', $supporter_user_id)->get();
        return response()->ok($schedule);
    }

    public function auto_update_all(Schedule\AutoRequest $request)
    {
        $supporter_user_id = Auth::id();
        $post_data = $request->except('supporter_user_id');
        $posts = [];
        foreach($post_data as $key => $data){
            if($data['is_available_all_day'] == 0) { //終日不可
                $posts[] = [
                    'supporter_user_id' => $supporter_user_id,
                    'day_of_week' => $data['day_of_week'],
                    'start_at' => NULL,
                    'end_at' => NULL,
                    'is_available_all_day' => $data['is_available_all_day'],
                ];
            } else { //予約可
                $posts[] = [
                    'supporter_user_id' => $supporter_user_id,
                    'day_of_week' => $data['day_of_week'],
                    'start_at' => $data['start_at'],
                    'end_at' => $data['end_at'],
                    'is_available_all_day' => $data['is_available_all_day'],
                ];
            }
        }
        (new AutoUpdateAllUseCase)($posts, $supporter_user_id);
        return response()->ok();
    }
}
