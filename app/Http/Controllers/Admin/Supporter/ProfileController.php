<?php

namespace App\Http\Controllers\Admin\Supporter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\Profile\StoreRequest;
use App\Http\Requests\Admin\Supporter\Profile\UpdateRequest;
use App\Models\SupporterProfile;
use App\UseCases\Admin\Supporter\Profile\ShowUseCase;
use App\UseCases\Admin\Supporter\Profile\CreateUseCase;
use App\UseCases\Admin\Supporter\Profile\UpdateUseCase;
use App\UseCases\Admin\Supporter\Profile\DeleteUseCase;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function index(ShowUseCase $showUC, $supporter_user_id = null)
    {
        $supporter_profile = $showUC($supporter_user_id);
        return response()->ok($supporter_profile);
    }

    public function store(StoreRequest $request, CreateUseCase $createUC, $supporter_user_id)
    {
        $data = [
            'supporter_user_id' => $supporter_user_id,
            'inoculation_status_id' => $request->inoculation_status_id,
            'title' => mb_substr($request->title, 0, 35),
            'self_introduction' => mb_substr($request->self_introduction, 0, 1000),
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

    public function update(UpdateRequest $request, UpdateUseCase $updateUC, $supporter_user_id)
    {
        $data = [
            'inoculation_status_id' => $request->inoculation_status_id,
            'title' => mb_substr($request->title, 0, 35),
            'self_introduction' => mb_substr($request->self_introduction, 0, 1000),
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

    public function destroy(DeleteUseCase $deleteUC, $supporter_user_id)
    {
        $deleteUC($supporter_user_id);
        return response()->ok();
    }
}
