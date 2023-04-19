<?php

namespace App\Http\Controllers\Admin\Guardian\Profile;

use App\Models\GuardianProfileImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UseCases\Admin\Guardian\GuardianProfileImage as GuardianProfileImageUseCase;
use App\Http\Requests\Admin\Guardian\Profile\ImageRequests as ImageRequests;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index(GuardianProfileImageUseCase\SearchUseCase $searchUC, $guardian_profiles_id)
    {
        $guardian_profile_images = $searchUC($guardian_profiles_id);
        return response()->ok($guardian_profile_images);
    }

    public function store(ImageRequests\StoreRequest $request,GuardianProfileImageUseCase\CreateUseCase $createUC, $guardian_profiles_id)
    {
        $create = [
            'guardian_profiles_id' => $guardian_profiles_id,
            'image_path' => $request->image_path,
            'which_image' => $request->which_image,
            'is_examination' => $request->is_examination
        ];
        $guardian_profile_images = $createUC($create);
        return response()->created();
    }

    public function show(GuardianProfileImageUseCase\SearchUseCase $searchUC, $guardian_profiles_id, $id)
    {
        $guardian_profile_images = $searchUC($guardian_profiles_id,$id);
        return response()->ok();
    }

    public function update(ImageRequests\UpdateRequest $request,GuardianProfileImageUseCase\UpdateUseCase $updateUC, $guardian_profiles_id, $id)
    {
        $update = [
            'image_path' => $request->image_path,
            'which_image' => $request->which_image,
            'is_examination' => $request->is_examination
        ];
        $guardian_profile_images = $updateUC($guardian_profiles_id,$id,$update);
        return response()->ok();
    }

    public function destroy(GuardianProfileImageUseCase\DeleteUseCase $deleteUC, $guardian_profiles_id, $id)
    {
        $guardian_profile_images = $deleteUC($guardian_profiles_id,$id);
        return response()->ok();
    }
}
