<?php

namespace App\UseCases\Admin\Supporter\ProfileImage;

use App\Models\SupporterProfileImage;


class DeleteUseCase
{
    public function __invoke($supporter_user_id)
    {
        return SupporterProfileImage::where("supporter_user_id", $supporter_user_id)->delete();
    }
}
