<?php

namespace App\UseCases\Admin\Supporter\User;

use App\Models\SupporterUser;
use Illuminate\Support\Facades\Hash;

class UpdateUseCase
{
    public function __invoke($data, $supporter_user_id)
    {
        $supporterUser = SupporterUser::where('id', $supporter_user_id)->update($data);
        return $supporterUser;
    }
}
