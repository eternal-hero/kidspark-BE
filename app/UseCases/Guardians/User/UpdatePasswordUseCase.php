<?php

namespace App\UseCases\Guardians\User;

use App\Models\GuardianUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordUseCase
{
    public function __invoke($request, $guardianId) {
        if (!Hash::check($request->current_password, Auth::user()->getAuthPassword())) {
            abort(404, 'Password does not match');
        }

        $guardian = GuardianUser::find($guardianId);
        $guardian->password = Hash::make($request->new_password);
        $guardian->save();
    }
}
