<?php

namespace App\Http\Controllers\Admin\Supporter\Housekeeping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\Housekeeping\SupportRequests as SupportRequests;
use App\UseCases\Admin\Supporter\Housekeeping\Support as SupportUseCase;

class SupportController extends Controller
{
    public function store(SupportRequests\StoreRequest $request,SupportUseCase\CreateUseCase $createUC, $supporter_user_id)
    {
        $create = [
            'settings_id' => $request->settings_id,
            'supporter_user_id' => $supporter_user_id,
            'acceptance_condition' => $request->acceptance_condition,
            'supported_service' => $request->supported_service,
        ];
        $housekeeping_setting = $createUC($create);
        return response()->created();
    }

    public function show(SupportUseCase\SearchUseCase $searchUC, $supporter_user_id)
    {
        $housekeeping_setting = $searchUC($supporter_user_id);
        return response()->ok($housekeeping_setting);
    }

    public function update(SupportRequests\UpdateRequest $request,SupportUseCase\UpdateUseCase $updateUC, $supporter_user_id)
    {
        $update = [
            'supporter_user_id' => $supporter_user_id,
            'acceptance_condition' => $request->acceptance_condition,
            'supported_service' => $request->supported_service,
        ];
        $housekeeping_setting = $updateUC($supporter_user_id,$update);
        return response()->ok();
    }

    public function destroy(SupportUseCase\DeleteUseCase $deleteUC, $supporter_user_id)
    {
        $housekeeping_setting = $deleteUC($supporter_user_id);
        return response()->ok();
    }
}
