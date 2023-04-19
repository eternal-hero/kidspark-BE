<?php
namespace App\UseCases\Admin\Guardian\GuardianProfileImage;

use App\Models\GuardianProfileImage;


class SearchUseCase
{
    public function __invoke($guardian_profiles_id = null,$id = null)
    {
        if(!is_null($guardian_profiles_id)){
            $guardian_profile_images = GuardianProfileImage::where('guardian_profiles_id',$guardian_profiles_id);
            if(!is_null($id)) $guardian_profile_images = $guardian_profile_images->where('id',$id);
            return $guardian_profile_images->get();
        }else{
            return GuardianProfileImage::all();
        }
    }
}