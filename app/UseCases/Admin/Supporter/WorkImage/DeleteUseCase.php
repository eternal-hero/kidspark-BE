<?php

namespace App\UseCases\Admin\Supporter\WorkImage;

use App\Models\SupporterWorksImage;


class DeleteUseCase
{
    public function __invoke($supporter_user_id, $works_image_id = null)
    {
        $supporter_works_image = SupporterWorksImage::where('supporter_user_id', $supporter_user_id);
        if (!is_null($works_image_id)) $supporter_works_image = $supporter_works_image->where('id', $works_image_id);
        return $supporter_works_image->delete();
    }
}
