<?php

namespace App\Http\Controllers\Admin\Guardian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UseCases\Admin\Guardian\GuardianNotice as GuardianNoticeUseCase;
use App\Http\Requests\Admin\Guardian\NoticeRequests as NoticeRequests;

class NoticeController extends Controller
{
    public function index(GuardianNoticeUseCase\SearchUseCase $searchUC, $guardian_user_id)
    {
        $guardian_notice = $searchUC($guardian_user_id);
        return response()->ok($guardian_notice);
    }

    public function store(NoticeRequests\StoreRequest $request,GuardianNoticeUseCase\CreateUseCase $createUC, $guardian_user_id)
    {
        $create = [
            'guardian_user_id' => $guardian_user_id,
            "is_reserve" => $request->is_reserve,
            "is_bbs" => $request->is_bbs,
            "is_message" => $request->is_message,
            "is_kidspark" => $request->is_kidspark
        ];
        $guardian_notice = $createUC($create);
        return response()->created();
    }

    public function show(GuardianNoticeUseCase\SearchUseCase $searchUC, $guardian_user_id, $id)
    {
        $guardian_notice = $searchUC($guardian_user_id,$id);
        return response()->ok($guardian_notice);
    }

    public function update(NoticeRequests\UpdateRequest $request,GuardianNoticeUseCase\UpdateUseCase $updateUC, $guardian_user_id,$id)
    {
        $update = [
            "is_reserve" => $request->is_reserve,
            "is_bbs" => $request->is_bbs,
            "is_message" => $request->is_message,
            "is_kidspark" => $request->is_kidspark
        ];
        $guardian_notice = $updateUC($guardian_user_id,$id,$update);
        return response()->ok();
    }

    public function destroy(GuardianNoticeUseCase\DeleteUseCase $deleteUC, $guardian_user_id, $id)
    {
        $guardian_notice = $deleteUC($guardian_user_id,$id);
        return response()->ok();
    }
}
