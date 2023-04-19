<?php

namespace App\Http\Controllers\Supporter\Housekeeping;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supporter\Housekeeping\SettingRequests as SettingRequests;
use App\UseCases\Supporter\Housekeeping\Setting as SettingUseCase;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function store(SettingRequests\StoreRequest $request,SettingUseCase\CreateUseCase $createUC)
    {
        $supporter_user_id = Auth::id();
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

    public function show(SettingUseCase\SearchUseCase $searchUC)
    {
        $supporter_user_id = Auth::id();
        $housekeeping_setting = $searchUC($supporter_user_id);
        return response()->ok($housekeeping_setting);
    }

    public function update(SettingRequests\UpdateRequest $request)
    {
        $supporter_user_id = Auth::id();
        $validatedData = $request->validated();
        (new SettingUseCase\UpdateUseCase)($validatedData, $supporter_user_id);
        return response()->ok();
    }

    public function destroy(SettingUseCase\DeleteUseCase $deleteUC)
    {
        $supporter_user_id = Auth::id();
        $housekeeping_setting = $deleteUC($supporter_user_id);
        return response()->ok();
    }
}
