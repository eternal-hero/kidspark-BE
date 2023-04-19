<?php

namespace App\Http\Controllers\Admin\Guardian\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UseCases\Admin\Guardian\GuardianProfile as GuardianProfileUseCase;
use App\Http\Requests\Admin\Guardian\Profile\ProfileRequests as ProfileRequests;

class ProfileController extends Controller
{
    public function index(GuardianProfileUseCase\SearchUseCase $searchUC, $guardian_user_id)
    {
        $guardian_profiles = $searchUC($guardian_user_id);
        return response()->ok($guardian_profiles);
    }

    public function store(ProfileRequests\StoreRequest $request,GuardianProfileUseCase\CreateUseCase $createUC, $guardian_user_id)
    {
        $create = [
            'guardian_user_id' => $guardian_user_id,
            'inoculation_status_id' => $request->inoculation_status_id,
            'title' => $request->title,
            'self_introduction' => $request->self_introduction,
            'near_line' => $request->near_line,
            'near_station' => $request->near_station,
            'means' => $request->means,
            'travel_time' => $request->travel_time,
            'is_publish' => $request->is_publish,
            'rule' => $request->rule
        ];
        $guardian_profiles = $createUC($create);
        return response()->created();
    }

    public function update(ProfileRequests\UpdateRequest $request,GuardianProfileUseCase\UpdateUseCase $updateUC, $guardian_user_id)
    {
        $update = [
            'inoculation_status_id' => $request->inoculation_status_id,
            'title' => $request->title,
            'self_introduction' => $request->self_introduction,
            'near_line' => $request->near_line,
            'near_station' => $request->near_station,
            'means' => $request->means,
            'travel_time' => $request->travel_time,
            'is_publish' => $request->is_publish,
            'rule' => $request->rule
        ];
        $guardian_profiles = $updateUC($guardian_user_id,$update);
        return response()->ok();
    }

    public function destroy(GuardianProfileUseCase\DeleteUseCase $deleteUC, $guardian_user_id)
    {
        $guardian_profiles = $deleteUC($guardian_user_id);
        return response()->ok();
    }
}
