<?php
namespace App\UseCases\Admin\Guardian\GuardianProfileImage;

use App\Models\GuardianProfileImage;
use Illuminate\Support\Facades\Storage;


class UpdateUseCase
{
    public function __invoke($guardian_profiles_id, $id, array $data)
    {
        $old_image_path = GuardianProfileImage::find($id)->image_path;
        $delete_path = ('public/' . $old_image_path);
        GuardianProfileImage::where('guardian_profiles_id', $guardian_profiles_id)->where('id', $id)->update($data);
        return Storage::delete($delete_path);
    }
}