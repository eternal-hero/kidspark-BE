<?php

namespace App\UseCases\Admin\Supporter\User;

use App\Models\SupporterUser;

class SearchUseCase
{
    public function __invoke($supporter_user_id)
    {
        if (is_null($supporter_user_id)) {
            return SupporterUser::all();
        }
        $supporterUser = SupporterUser::find($supporter_user_id);
        if (is_null($supporterUser)) {
            abort(404, "Supporter user not found");
        }
        return $supporterUser;
    }
}
