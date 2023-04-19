<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Http\Request;
use App\Models\AdminUser;
Use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::guard('admin_users')->attempt($request->validated())) {
            $adminUser = AdminUser::where('mail_address',$request->mail_address)->first();
            $adminUser->tokens()->delete();
            $token = $adminUser
                ->createToken("login:AdminUser{$adminUser->id}",[config('auth.abillity_keys.authenticated_admin_user')])
                ->plainTextToken;

            return response()->ok(['token' => $token ]);
        }

        return response()->internalError('AdminUser Not Found.');
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->ok();
    }
}
