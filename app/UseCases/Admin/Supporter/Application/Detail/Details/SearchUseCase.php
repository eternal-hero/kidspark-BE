<?php

namespace App\UseCases\Admin\Supporter\Application\Detail\Details;

use App\Models\SupporterApplicationDetail;

class SearchUseCase
{
    public function __invoke($data)
    {
        if (!array_key_exists('application_detail_id',$data)) {    
            $query = SupporterApplicationDetail::where('supporter_user_id', $data['supporter_user_id']);
            if(array_key_exists('update_at_lower_limit',$data))$query = $query->where('update_at','>=',$data['update_at_lower_limit']);
            if(array_key_exists('update_at_upper_limit',$data))$query = $query->where('update_at','<=',$data['update_at_upper_limit']);
            if(array_key_exists('status',$data))$query = $query->where('status',$data['status']);
            if(array_key_exists('subject',$data))$query = $query->where('subject','like',$data['subject']);//※
            if(array_key_exists('page',$data)){
                return $query->paginate(config('api.common.paginate_item_num.supporter_application_details'));    
            }else{
                return $query->get();
            }
        }else{
            $query = SupporterApplicationDetail::find($data['application_detail_id']);
            return $query;
        }
    }
}
