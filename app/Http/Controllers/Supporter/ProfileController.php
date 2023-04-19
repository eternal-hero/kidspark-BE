<?php

namespace App\Http\Controllers\Supporter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\Profile\StoreRequest;
use App\Http\Requests\Admin\Supporter\Profile\UpdateRequest;
use App\UseCases\Admin\Supporter\Profile\ShowUseCase;
use App\UseCases\Admin\Supporter\Profile\CreateUseCase;
use App\UseCases\Admin\Supporter\Profile\UpdateUseCase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(ShowUseCase $showUC)
    {
        $supporter_user_id = Auth::id();
        $supporter_profile = $showUC($supporter_user_id);
        return response()->ok($supporter_profile);
    }

    public function store(StoreRequest $request, CreateUseCase $createUC)
    {
        $supporter_user_id = Auth::id();
        $data = [
            'supporter_user_id' => $supporter_user_id,
            'inoculation_status_id' => $request->inoculation_status_id,
            'title' => $request->title,
            'self_introduction' => $request->self_introduction,
            'near_line' => $request->near_line,
            'near_station' => $request->near_station,
            'means' => $request->means,
            'travel_times' => $request->travel_times,
            'is_publish' => $request->is_publish,
            'time_between_appointment' => $request->time_between_appointment,
            'minimum_request_time' => $request->minimum_request_time,
            'reply_time' => $request->reply_time,
            'is_foreign_language' => $request->is_foreign_language,
        ];
        $createUC($data);

        return response()->created();
    }

    public function update(UpdateRequest $request, UpdateUseCase $updateUC)
    {
        $supporter_user_id = Auth::id();
        $data = [
            'inoculation_status_id' => $request->inoculation_status_id,
            'title' => $request->title,
            'self_introduction' => $request->self_introduction,
            'near_line' => $request->near_line,
            'near_station' => $request->near_station,
            'means' => $request->means,
            'travel_times' => $request->travel_times,
            'is_publish' => $request->is_publish,
            'time_between_appointment' => $request->time_between_appointment,
            'minimum_request_time' => $request->minimum_request_time,
            'reply_time' => $request->reply_time,
            'is_foreign_language' => $request->is_foreign_language,
        ];
        $updateUC($data, $supporter_user_id);

        return response()->ok();
    }
}
