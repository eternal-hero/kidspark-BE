<?php
namespace App\UseCases\Admin\Guardian\IdentityVerification;

use App\Models\IdentityVerification;


class SearchUseCase
{
    public function __invoke($guardian_user_id = null,$id = null)
    {
        if(!is_null($guardian_user_id)){
            $identity_verification = IdentityVerification::where('guardian_user_id',$guardian_user_id);
            if(!is_null($id)) $identity_verification = $identity_verification->where('id',$id);
            return $identity_verification->get();
        }else{
            return IdentityVerification::all();
        }
    }
}