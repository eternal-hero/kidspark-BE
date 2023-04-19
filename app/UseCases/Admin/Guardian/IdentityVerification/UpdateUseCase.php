<?php
namespace App\UseCases\Admin\Guardian\IdentityVerification;

use App\Models\IdentityVerification;


class UpdateUseCase
{
    public function __invoke($guardian_user_id, $id,array $data)
    {
        return IdentityVerification::where('guardian_user_id',$guardian_user_id)->where('id',$id)->update($data);
    }
}