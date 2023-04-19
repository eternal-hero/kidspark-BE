<?php

namespace App\Http\Controllers\Admin\Supporter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\ProfileImageRequests as ProfileImageRequests;
use App\UseCases\Admin\Supporter\ProfileImage\SearchUseCase;
use App\UseCases\Admin\Supporter\ProfileImage\CreateUseCase;
use App\UseCases\Admin\Supporter\ProfileImage\UpdateUseCase;
use App\UseCases\Admin\Supporter\ProfileImage\DeleteUseCase;

class ProfileImageController extends Controller
{
    public function index(SearchUseCase $searchUC, $supporter_user_id)
    {
        $supporter_profile_image = $searchUC($supporter_user_id);
        return response()->ok($supporter_profile_image);
    }

    public function store(ProfileImageRequests\StoreRequest $request, CreateUseCase $createUC, $supporter_user_id)
    {
        $data = [
            'supporter_user_id' => $supporter_user_id,
            'image_path' => $request->image_path,
        ];
        $supporter_profile_image = $createUC($data);
        return response()->created();
    }

    public function update(ProfileImageRequests\UpdateRequest $request, UpdateUseCase $updateUC, $supporter_user_id)
    {
        $data = [
            'image_path' => $request->image_path,
        ];
        $supporter_profile_image = $updateUC($supporter_user_id, $data);
        return response()->ok();
    }

    public function destroy(DeleteUseCase $deleteUC, $supporter_user_id)
    {
        $supporter_profile_image = $deleteUC($supporter_user_id);
        return response()->ok();
    }
}
