<?php

namespace App\UseCases\Supporter\User;

use App\Models\SupporterUser;

class SearchUseCase
{
    public function __invoke($supporter_user_id)
    {
        $supporterUser = SupporterUser::where('id', $supporter_user_id)
        ->with(["supporterWorksImages" => function($q) {
            $q->where('display_status', 0);
        }])->first();

        if (is_null($supporterUser)) {
            abort(404, "Supporter user not found");
        }
        return $supporterUser;
    }
}
