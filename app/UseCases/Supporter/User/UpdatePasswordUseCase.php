<?php

namespace App\UseCases\Supporter\User;

use App\Models\SupporterUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordUseCase
{
    public function __invoke($requestData, $supporter_user_id)
    {
        if (!Hash::check($requestData['current_password'], Auth::user()->getAuthPassword())) {
            abort(404, 'Password does not match');
        }
        $supporter = SupporterUser::find($supporter_user_id);
        $supporter->password = Hash::make($requestData['new_password']);
        $supporter->save();
    }
}
