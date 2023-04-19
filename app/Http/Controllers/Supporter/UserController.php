<?php

namespace App\Http\Controllers\Supporter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supporter\UserRequests\UpdateRequest;
use App\Models\SupporterProfileImage;
use App\Services\SupporterUserService;
use App\UseCases\Supporter\User\SearchUseCase as UserSearch;
use App\UseCases\Supporter\User\UpdateUseCase as UserUpdate;
use App\Http\Requests\Supporter\UserRequests\UpdatePasswordRequest;
use App\UseCases\Supporter\User\UpdatePasswordUseCase as PasswordUpdate;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Hash;
use App\Models\SupporterUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private SupporterUserService $supporterService;
    public function __construct(SupporterUserService $supporterService)
    {
        $this->supporterService = $supporterService;
    }
    public function index()
    {
        $supporter_user_id = Auth::id();
        $supportUsers = (new UserSearch)($supporter_user_id);
        return response()->ok($supportUsers);
    }

    public function update(UpdateRequest $request)
    {
        $supporter_user_id = Auth::id();
        $supporterUser = (new UserUpdate)($request->all(), $supporter_user_id);
        return response()->ok($supporterUser);
    }

    public function identification()
    {
        $supporter_user_id = Auth::id();
        $data = $this->supporterService->identificationInfo($supporter_user_id);
        return response()->okWithResource($data);
    }

    public function update_password(UpdatePasswordRequest $request)
    {
        $supporter_user_id = Auth::id();
        (new PasswordUpdate)($request->all(), $supporter_user_id);
        return response()->ok();
    }

    public function updateAvatar(Request $request)
    {
        $supporter = Auth::user();
        $profileImage = $supporter->supporterProfileImage;
        $img = Storage::disk('public')->putFile('supporter/profile-images', $request->file('avatar'));
        if (is_null($profileImage)) {
            $profileImage = new SupporterProfileImage();
            $profileImage->supporter_user_id = $supporter->id;
        } else if ($profileImage->image_path) {
            Storage::disk('public')->delete($profileImage->image_path);
        }
        $profileImage->image_path = $img;
        $profileImage->save();
        return response()->ok($profileImage);
    }
}
