<?php

namespace App\Http\Controllers\Guardians;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Guardians\Auth\LoginRequest;

use App\Models\GuardianUser;
Use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::guard('guardian_users')->attempt($request->validated())) {
            $guardianUser = GuardianUser::where('mail_address',$request->mail_address)->first();
            $guardianUser->tokens()->delete();
            $token = $guardianUser
                ->createToken("login:GuarianUser{$guardianUser->id}",[config('auth.abillity_keys.authenticated_guardian_user')])
                ->plainTextToken;

            return response()->ok(['token' => $token ]);
        }

        return response()->internalError('GuarianUser Not Found.');
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->ok();
    }
}
