<?php

namespace App\UseCases\Admin\Supporter\ProfileImage;

use App\Models\SupporterProfileImage;


class UpdateUseCase
{
    public function __invoke($supporter_user_id, array $data)
    {
        return SupporterProfileImage::where('supporter_user_id', $supporter_user_id)->update($data);
    }
}
