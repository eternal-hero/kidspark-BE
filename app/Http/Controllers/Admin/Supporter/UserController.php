<?php

namespace App\Http\Controllers\Admin\Supporter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\UserRequests as UserRequests;
use App\UseCases\Admin\Supporter\User as UserUseCase;
Use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(UserRequests\IndexRequest $request)
    {
        $post_data = $request->validated();
        if($request->page)$post_data = $post_data + ['page' => $request->page];
        $supporterUser = (new UserUseCase\IndexUseCase)($post_data);
        return response()->ok($supporterUser);
    }

    public function show($supporter_user_id)
    {
        $supporterUser = (new UserUseCase\SearchUseCase)($supporter_user_id);
        $supporterProfileImage = $supporterUser->supporterProfileImage;
        $supporterUser = $supporterUser->only(array_merge(['id'],config('api.supporter.user_param.profile')));
        $supporterUser['supporter_profile_image'] = $supporterProfileImage;
        return response()->ok($supporterUser);
    }

    public function store(UserRequests\StoreRequest $request)
    {
        $create = $request->validated();
        $create['password'] = Hash::make($create['password']);
        $supporterUser = (new UserUseCase\StoreUseCase)($create);
        return response()->ok($supporterUser);
    }

    public function update(UserRequests\UpdateProfileRequest $request, $supporter_user_id)
    {
        $update = $request->validated();
        $supporterUser = (new UserUseCase\UpdateUseCase)($update, $supporter_user_id);
        return response()->ok($supporterUser);
    }

    public function destroy($supporter_user_id)
    {
        (new UserUseCase\DeleteUseCase)($supporter_user_id);
        return response()->ok();
    }

    public function update_password(UserRequests\UpdatePasswordRequest $request, $supporter_user_id)
    {
        $update = [
            'password' => Hash::make($request->password),
        ];
        $supporter_users = (new UserUseCase\UpdateUseCase)($update,$supporter_user_id);
        return response()->ok();
    }
}
