<?php
namespace App\UseCases\BeforeLogin\Guardian\TmpGuardianUser;

use App\Models\TmpGuardianUser;
use Illuminate\Support\Facades\Hash;


class VerificationEmailUseCase
{
    public function __invoke(array $data)
    {
        $tmp_guardain_user = TmpGuardianUser::where('mail_address',$data['mail_address'])->latest()->first();
        if(!is_null($tmp_guardain_user)){
            if(Hash::check($data['auth_code'], $tmp_guardain_user->auth_code)) {
                if($tmp_guardain_user->email_verified == 0){
                    $tmp_guardain_user->email_verified = 1;
                    $tmp_guardain_user->save();
                }
                unset($tmp_guardain_user->id);
                unset($tmp_guardain_user->email_verified);
                unset($tmp_guardain_user->password);
                unset($tmp_guardain_user->created_at);
                unset($tmp_guardain_user->updated_at);
                return $tmp_guardain_user;
            }
            return false;
        }else{
            abort(404, "PreGuardianUser not found");
        }
    }
}
