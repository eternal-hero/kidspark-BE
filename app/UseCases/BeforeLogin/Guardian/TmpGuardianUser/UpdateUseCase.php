<?php
namespace App\UseCases\BeforeLogin\Guardian\TmpGuardianUser;

use App\Models\TmpGuardianUser;


class UpdateUseCase
{
    public function __invoke($auth_code,array $data)
    {
        $tmp_guardain_user = TmpGuardianUser::where('mail_address',$data['mail_address'])->where('auth_code',$auth_code)->latest()->first();
        if(!is_null($tmp_guardain_user)){
            $tmp_guardain_user->update($data);
            return $tmp_guardain_user->mail_address;
        }else{
            abort(404, "PreGuardianUser not found");
        }

    }
}
