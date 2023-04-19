<?php
namespace App\UseCases\Admin\Guardian\GuardianProfile;

use App\Models\GuardianProfile;


class UpdateUseCase
{
    public function __invoke($guardian_user_id,array $data)
    {
        return GuardianProfile::where('guardian_user_id',$guardian_user_id)->update($data);
    }
}