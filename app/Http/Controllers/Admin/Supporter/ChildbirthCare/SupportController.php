<?php

namespace App\Http\Controllers\Admin\Supporter\ChildbirthCare;

use App\Http\Requests\Admin\Supporter\ChildbirthCare\SupportRequests as SupportRequests;
use App\UseCases\Admin\Supporter\ChildbirthCare\Support as SupportUseCase;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    public function show($supporter_user_id)
    {
        $supporterSupport = (new SearchUseCase)($supporter_user_id);
        return response()->ok($supporterSupport);
    }

    public function store(StoreRequest $request)
    {
        $create = $request->validated();
        $supporterSupport = (new CreateUseCase)($create);
        return response()->ok($supporterSupport);
    }

    public function update(UpdateRequest $request)
    {
        $supporter_user_id = $request->only('supporter_user_id');
        $update = $request->except('supporter_user_id');
        $supporterSupport = (new UpdateUseCase)($update, $supporter_user_id);
        return response()->ok($supporterSupport);
    }

    public function delete($supporter_user_id)
    {
        (new DeleteUseCase)($supporter_user_id);
        return response()->ok();
    }
}
