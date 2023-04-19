<?php

namespace App\Http\Controllers\Guardians;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UseCases\Guardians\GuardianProfileImage as GuardianProfileImageUseCase;
use Illuminate\Support\Facades\Auth;
use App\Models\GuardianProfile;

class ProfileImageController extends Controller
{
    public function index(GuardianProfileImageUseCase\SearchUseCase $searchUC)
    {
        $guardian_user_id = Auth::id();
        $guardian_profiles_id = GuardianProfile::where('guardian_user_id', $guardian_user_id)->value('id');
        $guardian_profile_images = $searchUC($guardian_profiles_id);
        return response()->ok($guardian_profile_images);
    }

    public function update_all(Request $request,GuardianProfileImageUseCase\UpdateAllUseCase $updateUC)
    {
        $guardian_user_id = Auth::id();
        $guardian_profiles_id = GuardianProfile::where('guardian_user_id', $guardian_user_id)->value('id');
        $post_data = $request->except('guardian_profiles_id');
        $posts = [];
        foreach($post_data as $key => $data) {
            $posts[] = [
                'guardian_profiles_id' => $guardian_profiles_id,
                'image_path' => $data['image_path'] ?? null,
                'which_image' => $data['which_image'],
                'is_examination' => $data['is_examination'] ?? 0
            ];
        }
        $guardian_profile_images = $updateUC($posts,$guardian_profiles_id);
        return response()->ok();
    }
}
