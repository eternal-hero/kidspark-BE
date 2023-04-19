<?php

namespace App\Http\Controllers\Supporter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Supporter\Auth\LoginRequest;

use App\Models\SupporterUser;
Use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::guard('supporter_users')->attempt($request->validated())) {
            $supporterUser = SupporterUser::where('mail_address',$request->mail_address)->first();
            $supporterUser->tokens()->delete();

            $token = $supporterUser
                ->createToken("login:SupporterUser{$supporterUser->id}",[config('auth.abillity_keys.authenticated_supporter_user')])
                ->plainTextToken;

            return response()->ok(['token' => $token ]);
        }

        return response()->internalError('SupporterUser Not Found.');
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->ok();
    }
}
