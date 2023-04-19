<?php

namespace App\Http\Controllers\Guardians;

use App\Http\Controllers\Controller;
use App\UseCases\Guardians\GuardianProfile as GuardianProfileUseCase;
use App\Http\Requests\Guardians\ProfileRequests as ProfileRequests;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index(GuardianProfileUseCase\SearchUseCase $searchUC)
    {
        $guardian_user_id = Auth::id();
        $guardian_profiles = $searchUC($guardian_user_id);
        return response()->ok($guardian_profiles);
    }

    public function update(ProfileRequests\UpdateProfileRequest $request)
    {
        $guardian_user_id = Auth::id();
        (new GuardianProfileUseCase\UpdateUseCase)($guardian_user_id, $request->validated());
        return response()->ok();
    }

    public function store(ProfileRequests\StoreRequest $request)
    {
        $guardianProfile = (new GuardianProfileUseCase\CreateUseCase)($request->validated());
        return response()->ok($guardianProfile);
    }
}
