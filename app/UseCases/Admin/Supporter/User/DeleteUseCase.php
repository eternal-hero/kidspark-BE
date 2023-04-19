<?php

namespace App\UseCases\Admin\Supporter\User;

use App\Models\SupporterUser;

class DeleteUseCase
{
    public function __invoke($supporter_user_id)
    {
        SupporterUser::where("id", $supporter_user_id)->delete();
    }
}
