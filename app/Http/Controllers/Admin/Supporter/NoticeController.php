<?php

namespace App\Http\Controllers\Admin\Supporter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\NoticeRequests as NoticeRequests;
use App\UseCases\Admin\Supporter\Notice as NoticeUseCase;

class NoticeController extends Controller
{
    public function store(NoticeRequests\StoreRequest $request,NoticeUseCase\CreateUseCase $createUC, $supporter_user_id)
    {
        $create = [
            'supporter_user_id' => $supporter_user_id,
            'is_request' => $request->is_request,
            'is_task' => $request->is_task,
            'is_management' => $request->is_management,
            'is_parent' => $request->is_parent
        ];
        $notice = $createUC($create);
        return response()->created();
    }

    public function show(NoticeUseCase\SearchUseCase $searchUC, $supporter_user_id)
    {
        $notice = $searchUC($supporter_user_id);
        return response()->ok($notice);
    }

    public function update(NoticeRequests\UpdateRequest $request,NoticeUseCase\UpdateUseCase $updateUC, $supporter_user_id)
    {
        $update = [
            'is_request' => $request->is_request,
            'is_task' => $request->is_task,
            'is_management' => $request->is_management,
            'is_parent' => $request->is_parent
        ];
        $notice = $updateUC($supporter_user_id,$update);
        return response()->ok();
    }

    public function destroy(NoticeUseCase\DeleteUseCase $deleteUC, $supporter_user_id)
    {
        $notice = $deleteUC($supporter_user_id);
        return response()->ok();
    }
}
