<?php

namespace App\Http\Controllers\Admin\Supporter;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Supporter\PreInterviewSettingRequests\StoreRequest;
use App\Http\Requests\Admin\Supporter\PreInterviewSettingRequests\UpdateRequest;
use App\UseCases\Admin\Supporter\PreInterviewSetting\SearchUseCase;
use App\UseCases\Admin\Supporter\PreInterviewSetting\CreateUseCase;
use App\UseCases\Admin\Supporter\PreInterviewSetting\UpdateUseCase;
use App\UseCases\Admin\Supporter\PreInterviewSetting\DeleteUseCase;

class PreInterviewSettingController extends Controller
{
    public function index(SearchUseCase $showUC, $supporter_user_id)
    {
        $pre_interview_settings = $showUC($supporter_user_id);
        return response()->ok($pre_interview_settings);
    }

    public function store(StoreRequest $request, CreateUseCase $createUC, $supporter_user_id)
    {
        $data = [
            'supporter_user_id' => $supporter_user_id,
            'initial_meeting_comment' => $request->initial_meeting_comment,
            'web_meeting_fee' => $request->web_meeting_fee,
            'facetoface_meeting_fee' => $request->facetoface_meeting_fee,
        ];
        $pre_interview_settings = $createUC($data);
        return response()->created();
    }

    public function update(UpdateRequest $request, UpdateUseCase $updateUC, $supporter_user_id)
    {
        $data = [
            'initial_meeting_comment' => $request->initial_meeting_comment,
            'web_meeting_fee' => $request->web_meeting_fee,
            'facetoface_meeting_fee' => $request->facetoface_meeting_fee,
        ];
        $pre_interview_settings = $updateUC($supporter_user_id, $data);
        return response()->ok();
    }

    public function destroy(DeleteUseCase $deleteUC, $supporter_user_id)
    {
        $pre_interview_settings = $deleteUC($supporter_user_id);
        return response()->ok();
    }
}
