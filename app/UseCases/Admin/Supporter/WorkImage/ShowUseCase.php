<?php

namespace App\UseCases\Admin\Supporter\WorkImage;

use App\Models\SupporterWorksImage;
use Illuminate\Http\Resources\Json\JsonResource;


class ShowUseCase
{
    public function __invoke($supporter_user_id, $works_image_id)
    {
        return new JsonResource(
            SupporterWorksImage::where('supporter_user_id', $supporter_user_id)->first()
                ->where('id', $works_image_id)
                ->first()
        );
    }
}
