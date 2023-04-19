<?php

namespace App\Http\Controllers\Supporter;

use App\Http\Controllers\Controller;

use App\Http\Requests\Supporter\PreInterviewSettingRequests\StoreRequest;
use App\Http\Requests\Supporter\PreInterviewSettingRequests\UpdateRequest;
use App\UseCases\Supporter\PreInterviewSetting\SearchUseCase;
use App\UseCases\Supporter\PreInterviewSetting\CreateUseCase;
use App\UseCases\Supporter\PreInterviewSetting\UpdateUseCase;
use App\UseCases\Supporter\PreInterviewSetting\DeleteUseCase;
use Illuminate\Support\Facades\Auth;

class PreInterviewSettingController extends Controller
{
    public function index(SearchUseCase $showUC)
    {
        $supporter_user_id = Auth::id();
        $pre_interview_settings = $showUC($supporter_user_id);
        return response()->ok($pre_interview_settings);
    }

    public function store(StoreRequest $request, CreateUseCase $createUC)
    {
        $data = $request->validated();
        $data['supporter_user_id'] = Auth::id();
        $pre_interview_settings = $createUC($data);
        return response()->okWithResource($pre_interview_settings);
    }

    public function update(UpdateRequest $request, UpdateUseCase $updateUC)
    {
        $supporter_user_id = Auth::id();
        $pre_interview_settings = $updateUC($supporter_user_id, $request->validated());
        return response()->ok();
    }

    public function destroy(DeleteUseCase $deleteUC)
    {
        $supporter_user_id = Auth::id();
        $pre_interview_settings = $deleteUC($supporter_user_id);
        return response()->ok();
    }
}
