<?php
namespace App\UseCases\Admin\Guardian\GuardianProfile;

use App\Models\GuardianProfile;


class SearchUseCase
{
    public function __invoke($guardian_user_id = null)
    {
        if(!is_null($guardian_user_id)){
                return GuardianProfile::where('guardian_user_id',$guardian_user_id)->get();
        }else{
            return GuardianProfile::all();
        }
    }
}