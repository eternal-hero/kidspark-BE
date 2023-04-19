<?php

namespace App\Http\Controllers\Admin\Supporter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\SettingRequests\StoreRequest;
use App\Http\Requests\Admin\Supporter\SettingRequests\UpdateRequest;
use App\UseCases\Admin\Supporter\Setting\DeleteUseCase as SettingDelete;
use App\UseCases\Admin\Supporter\Setting\SearchUseCase as SettingSearch;
use App\UseCases\Admin\Supporter\Setting\StoreUseCase as SettingStore;
use App\UseCases\Admin\Supporter\Setting\UpdateUseCase as SettingUpdate;

class SettingController extends Controller
{
    public function index($supporter_user_id)
    {
        $setting = (new SettingSearch)($supporter_user_id);
        return response()->ok($setting);
    }

    public function store(StoreRequest $request, $supporter_user_id)
    {
        $create = [
            'settings_id' => $request->settings_id,
            'supporter_user_id' => $supporter_user_id,
            'is_supporter' => $request->is_supporter,
            'single_fee' => $request->single_fee,
            'regular_fee' => $request->regular_fee,
            'special' => $request->special,
            'service' => $request->service,
            'potential_entrant' => $request->potential_entrant,
            'minimum_age_limit' => $request->minimum_age_limit,
            'maximum_age_limit' => $request->maximum_age_limit
        ];
        $setting = (new SettingStore)($create);
        return response()->ok($setting);
    }

    public function update(UpdateRequest $request, $supporter_user_id)
    {
        $update = [
            'is_supporter' => $request->is_supporter,
            'single_fee' => $request->single_fee,
            'regular_fee' => $request->regular_fee,
            'special' => $request->special,
            'service' => $request->service,
            'potential_entrant' => $request->potential_entrant,
            'minimum_age_limit' => $request->minimum_age_limit,
            'maximum_age_limit' => $request->maximum_age_limit
        ];
        $setting = (new SettingUpdate)($supporter_user_id, $update);
        return response()->ok($setting);
    }

    public function delete($supporter_user_id)
    {
        (new SettingDelete)($supporter_user_id);
        return response()->ok();
    }
}
