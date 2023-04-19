<?php

namespace App\UseCases\Supporter\WorkImage;

use App\Models\SupporterWorksImage;


class ShowUseCase
{
    public function __invoke($data)
    {
        if (array_key_exists('supporter_user_id',$data)) {
            $supporter_works_image = SupporterWorksImage::where('supporter_user_id', $data['supporter_user_id']);
            if (array_key_exists('works_image_id',$data)) $supporter_works_image = $supporter_works_image->where('id', $data['works_image_id']);
            if(array_key_exists('page',$data)){
                return $supporter_works_image->paginate(config('api.common.paginate_item_num.supporter_works_image'));
            }else{
                return $supporter_works_image->get();
            }
        } else {
            return SupporterWorksImage::all();
        }
    }
}
