<?php
namespace App\UseCases\BeforeLogin\Guardian\TmpGuardianUser;

use App\Models\TmpGuardianUser;


class ChangeAuthCodeUseCase
{
    public function __invoke(array $data)
    {

        $tmp_guardain_user = TmpGuardianUser::where('mail_address',$data['mail_address'])->where('email_verified',0)->latest()->first();
        if(!is_null($tmp_guardain_user)){
            $tmp_guardain_user->auth_code = $data['auth_code'];
            $tmp_guardain_user->save();
            return $tmp_guardain_user;
        }else{
            abort(404, "PreGuardianUser not found");
        }
    }
}
