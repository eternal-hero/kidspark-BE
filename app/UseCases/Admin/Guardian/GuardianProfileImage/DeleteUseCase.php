<?php
namespace App\UseCases\Admin\Guardian\GuardianProfileImage;

use App\Models\GuardianProfileImage;
use Illuminate\Support\Facades\Storage;


class DeleteUseCase
{
    public function __invoke($guardian_profiles_id, $id = null)
    {
        $old_image_path = GuardianProfileImage::find($id)->image_path;
        $delete_path = ('public/' . $old_image_path);
        $guardian_profile_images = GuardianProfileImage::where('guardian_profiles_id', $guardian_profiles_id);
        if (!is_null($id))
            $guardian_profile_images = $guardian_profile_images->where('id', $id);
        $guardian_profile_images->delete();
        return Storage::delete($delete_path);
    }
}