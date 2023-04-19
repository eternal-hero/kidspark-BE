<?php

namespace App\Http\Controllers\Admin\Supporter\Housekeeping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\Housekeeping\SettingRequests as SettingRequests;
use App\UseCases\Admin\Supporter\Housekeeping\Setting as SettingUseCase;

class SettingController extends Controller
{
    public function store(SettingRequests\StoreRequest $request,SettingUseCase\CreateUseCase $createUC, $supporter_user_id)
    {
        $create = [
            'settings_id' => $request->settings_id,
            'supporter_user_id' => $supporter_user_id,
            'is_housework' => $request->is_housework,
            'single_fee' => $request->single_fee,
            'regular_fee' => $request->regular_fee,
            'special'=> $request->special,
            'service'=> $request->service
        ];
        $housekeeping_setting = $createUC($create);
        return response()->created();
    }

    public function show(SettingUseCase\SearchUseCase $searchUC, $supporter_user_id)
    {
        $housekeeping_setting = $searchUC($supporter_user_id);
        return response()->ok($housekeeping_setting);
    }

    public function update(SettingRequests\UpdateRequest $request,SettingUseCase\UpdateUseCase $updateUC, $supporter_user_id)
    {
        $update = [
            'supporter_user_id' => $supporter_user_id,
            'is_housework' => $request->is_housework,
            'single_fee' => $request->single_fee,
            'regular_fee' => $request->regular_fee,
            'special'=> $request->special,
            'service'=> $request->service
        ];
        $housekeeping_setting = $updateUC($supporter_user_id,$update);
        return response()->ok();
    }

    public function destroy(SettingUseCase\DeleteUseCase $deleteUC, $supporter_user_id)
    {
        $housekeeping_setting = $deleteUC($supporter_user_id);
        return response()->ok();
    }
}
