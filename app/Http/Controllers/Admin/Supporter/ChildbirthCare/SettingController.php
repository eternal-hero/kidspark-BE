<?php

namespace App\Http\Controllers\Admin\Supporter\ChildbirthCare;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\ChildbirthCare\SettingRequests as SettingRequests;
use App\UseCases\Admin\Supporter\ChildbirthCare\Setting as SettingUseCase;
use Carbon\Carbon;

class SettingController extends Controller
{
    public function show($supporter_user_id)
    {
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
        $supporter_user_id = $request->only('supporter_user_id');
        $update = $request->except('setting_is', 'supporter_user_id', 'created_at');
        $update['updated_at'] = Carbon::now();
        $setting = (new SettingUseCase\UpdateUseCase)($supporter_user_id, $update);
        return response()->ok($setting);
    }

    public function delete($supporter_user_id)
    {
        (new SettingUseCase\DeleteUseCase)($supporter_user_id);
        return response()->ok();
    }
}
