<?php
namespace App\UseCases\Guardians\GuardianProfile;

use App\Models\GuardianProfile;


class SearchUseCase
{
    public function __invoke($guardian_user_id = null)
    {
        if(!is_null($guardian_user_id)){
            return GuardianProfile::where('guardian_user_id', $guardian_user_id)->first();
        }else{
            return GuardianProfile::all();
        }
    }
}
