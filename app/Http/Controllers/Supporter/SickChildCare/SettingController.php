<?php

namespace App\Http\Controllers\Supporter\SickChildCare;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supporter\SickChildCare\SettingRequests as SettingRequests;
use App\UseCases\Supporter\SickChildCare\Setting as SettingUseCase;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function show()
    {
        $supporter_user_id = Auth::id();
        $setting = (new SettingUseCase\SearchUseCase)($supporter_user_id);
        return response()->ok($setting);
    }

    public function store(SettingRequests\StoreRequest $request)
    {
        $create = $request->validated();
        $setting = (new SettingUseCase\StoreUseCase)($create);
        return response()->ok($setting);
    }

    public function update(SettingRequests\UpdateRequest $request)
    {
        $supporter_user_id = Auth::id();
        (new SettingUseCase\UpdateUseCase)($request->validated(), $supporter_user_id);
        return response()->ok();
    }

    public function delete()
    {
        $supporter_user_id = Auth::id();
        (new SettingUseCase\DeleteUseCase)($supporter_user_id);
        return response()->ok();
    }
}
