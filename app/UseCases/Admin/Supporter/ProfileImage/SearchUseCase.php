<?php

namespace App\UseCases\Admin\Supporter\ProfileImage;

use App\Models\SupporterProfileImage;


class SearchUseCase
{
    public function __invoke($supporter_user_id = null)
    {
        if (!is_null($supporter_user_id)) {
            return SupporterProfileImage::where('supporter_user_id', $supporter_user_id)->get();
        } else {
            return SupporterProfileImage::all();
        }
    }
}
