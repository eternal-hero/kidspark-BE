<?php

namespace App\UseCases\Admin\Supporter\WorkImage;

use App\Models\SupporterWorksImage;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexUseCase
{
    public function __invoke($supporter_user_id)
    {
        $per_page = config('api.common.paginate_item_num.supporter_works_image');
        return new JsonResource(
            SupporterWorksImage::where('supporter_user_id', $supporter_user_id)
                ->paginate($per_page)
        );
    }
}
