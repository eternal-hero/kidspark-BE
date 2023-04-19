<?php

namespace App\UseCases\Supporter\WorkImage;

use App\Models\SupporterWorksImage;


class UpdateUseCase
{
    public function __invoke($supporter_user_id, $works_image_id, array $data)
    {
        return SupporterWorksImage::where('supporter_user_id', $supporter_user_id)->where('id', $works_image_id)->update($data);
    }
}
