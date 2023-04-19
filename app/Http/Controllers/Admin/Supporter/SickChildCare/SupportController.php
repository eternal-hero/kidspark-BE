<?php

namespace App\Http\Controllers\Admin\Supporter\SickChildCare;

use App\Http\Requests\Admin\Supporter\SickChildCare\SupportRequests as SupportRequests;
use App\UseCases\Admin\Supporter\SickChildCare\Support as SupportUseCase;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    public function show($supporter_user_id)
    {
        $supporterSupport = (new SupportUseCase\SearchUseCase)($supporter_user_id);
        return response()->ok($supporterSupport);
    }

    public function store(SupportRequests\StoreRequest $request)
    {
        $create = $request->validated();
        $supporterSupport = (new SupportUseCase\CreateUseCase)($create);
        return response()->ok($supporterSupport);
    }

    public function update(SupportRequests\UpdateRequest $request, $supporter_user_id)
    {
        $supporter_user_id = $request->only('supporter_user_id');
        $update = $request->except('supporter_user_id');
        $supporterSupport = (new SupportUseCase\UpdateUseCase)($update, $supporter_user_id);
        return response()->ok($supporterSupport);
    }

    public function delete($supporter_user_id)
    {
        (new SupportUseCase\DeleteUseCase)($supporter_user_id);
        return response()->ok();
    }
}
