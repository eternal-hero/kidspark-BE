<?php

namespace App\Http\Controllers\BeforeLogin\Guardian;

use App\Http\Controllers\Controller;
use App\Http\Requests\BeforeLogin\Guardian\TmpGuardianUserRequests\StoreRequest;
use App\Http\Requests\BeforeLogin\Guardian\TmpGuardianUserRequests\UpdateRequest;
use App\Http\Requests\BeforeLogin\Guardian\TmpGuardianUserRequests\VerificationEmailRequest;
use App\Http\Requests\BeforeLogin\Guardian\TmpGuardianUserRequests\ResendAuthCodeRequest;
use App\Mail\TmpGuardianUserRegisterMail;
use Illuminate\Support\Facades\Hash;
use App\UseCases\BeforeLogin\Guardian\TmpGuardianUser as TmpGuardianUserUseCase;
use Illuminate\Support\Facades\Mail;

class TmpGuardianUserController extends Controller
{
    private function createAuthCode()
    {
        $random_int = random_int(0,999999);
        $auth_code = str_pad($random_int, 6, 0, STR_PAD_LEFT);
        return $auth_code;
    }

    public function store(TmpGuardianUserUseCase\CreateUseCase $createUC,StoreRequest $request)
    {
        $auth_code = $this->createAuthCode();
        $hashed_auth_code = Hash::make($auth_code);
        $data = [
            'auth_code' => $hashed_auth_code,
            'mail_address' => $request->mail_address,
        ];
        $response_data['mail_address'] = $data['mail_address'];
        $createUC($data);
        Mail::to($request->mail_address)->send(new TmpGuardianUserRegisterMail($auth_code));
        return response()->ok($response_data);
    }

    public function update(TmpGuardianUserUseCase\UpdateUseCase $updateUC,UpdateRequest $request)
    {
        $auth_code = $request->header('Auth-Code-For-Pre-Guardian-User');
        if(!$auth_code){
            return response()->invalidRequestParameter("認証コードが設定されていません。");
        }
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $response_data = $updateUC($auth_code,$data);
        return response()->ok($response_data);
    }

    public function verificationEmail(TmpGuardianUserUseCase\VerificationEmailUseCase $verification_emailUC,VerificationEmailRequest $request)
    {
        $data = [
            'mail_address' => $request->mail_address,
            'auth_code' => $request->auth_code,
        ];
        $response_data = $verification_emailUC($data);
        if(!$response_data){
            return response()->internalError("認証に失敗しました。");
        }
        return response()->ok($response_data);

    }

    public function resendAuthCode(TmpGuardianUserUseCase\ChangeAuthCodeUseCase $change_auth_codeUC,ResendAuthCodeRequest $request)
    {
        $auth_code = $this->createAuthCode();
        $hashed_auth_code = Hash::make($auth_code);
        $data = [
            'auth_code' => $hashed_auth_code,
            'mail_address' => $request->mail_address,
        ];
        $response_data['mail_address'] = $data['mail_address'];
        $change_auth_codeUC($data);
        Mail::to($request->mail_address)->send(new TmpGuardianUserRegisterMail($auth_code));
        return response()->ok($response_data);
    }

}
