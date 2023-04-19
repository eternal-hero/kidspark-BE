<?php
namespace App\UseCases\Guardians\GuardianProfile;

use App\Models\GuardianProfile;
use Illuminate\Support\Facades\Auth;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        $data['guardian_user_id'] = Auth::id();
        return GuardianProfile::create($data);
    }
}
