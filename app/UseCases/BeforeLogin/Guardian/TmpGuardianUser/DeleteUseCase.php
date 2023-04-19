<?php
namespace App\UseCases\BeforeLogin\Guardian\TmpGuardianUser;

use App\Models\TmpGuardianUser;


class DeleteUseCase
{
    public function __invoke(array $data)
    {

        $tmp_guardian_user = TmpGuardianUser::where("mail_address", $data['mail_address']);
        if(!is_null($tmp_guardian_user)){
            return $tmp_guardian_user->delete();
        }else{
            abort(404, "PreGuardianUser not found");
        }
    }
}
