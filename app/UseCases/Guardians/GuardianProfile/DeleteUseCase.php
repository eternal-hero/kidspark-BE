<?php
namespace App\UseCases\Guardians\GuardianProfile;

use App\Models\GuardianProfile;


class DeleteUseCase
{
    public function __invoke($guardian_user_id)
    {
        return GuardianProfile::where('guardian_user_id',$guardian_user_id)->delete();
    }
}