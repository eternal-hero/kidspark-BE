<?php
namespace App\UseCases\Admin\Guardian\IdentityVerification;

use App\Models\IdentityVerification;


class DeleteUseCase
{
    public function __invoke($guardian_user_id, $id = null)
    {
        $identity_verification = IdentityVerification::where('guardian_user_id',$guardian_user_id);
        if(!is_null($id))$identity_verification = $identity_verification->where('id',$id);
        return $identity_verification->delete();
    }
}