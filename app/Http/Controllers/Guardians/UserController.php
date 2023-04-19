<?php

namespace App\Http\Controllers\Guardians;

use App\Http\Controllers\Controller;
use App\UseCases\Guardians\User as UserUseCase;
use App\Http\Requests\Guardians\UserRequests as UserRequests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(UserUseCase\SearchUseCase $searchUC)
    {
        $guardian_user_id = Auth::id();
        $guardian_users = $searchUC($guardian_user_id);
        if ($guardian_users) {
            // 保護者のIDで取得できる
            return response()->ok($guardian_users);
        } else {
            // 保護者が存在していない
            return response()->notFound('Guardian Not Found.');
        }
    }

    public function show(UserUseCase\SearchUseCase $searchUC, $id)
    {
        $guardian_users = $searchUC($id);
        return response()->ok($guardian_users);
    }

    public function update(UserRequests\UpdateRequest $request, UserUseCase\UpdateUseCase $updateUC)
    {
        $id = Auth::id();
        $updated_guardian_users = $updateUC($id, $request->validated());
        if ($updated_guardian_users) {
            // 成功
            return response()->ok();
        } else {
            // 保護者が存在していない/失敗
            return response()->notFound('Guardian Not Found.');
        }
    }

    public function update_password(UserRequests\UpdatePasswordRequest $request)
    {
        $guardianId = Auth::id();
        (new UserUseCase\UpdatePasswordUseCase())($request, $guardianId);
        return response()->ok();
    }

}
