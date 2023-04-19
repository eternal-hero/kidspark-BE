<?php

namespace App\UseCases\Admin\Supporter\Application\Document;

use App\Models\SupporterApplicationDocument;

class SearchUseCase
{
    public function __invoke($data)
    {
        if (!array_key_exists('application_document_id',$data)) {    
            $query = SupporterApplicationDocument::where('supporter_user_id', $data['supporter_user_id']);
            if(array_key_exists('file_id',$data))$query = $query->where('file_id',$data['file_id']);
            if(array_key_exists('status',$data))$query = $query->where('status',$data['status']);
            if(array_key_exists('category',$data))$query = $query->where('category',$data['category']);
            if(array_key_exists('application_at_lower_limit',$data))$query = $query->where('application','>=',$data['application_at_lower_limit']);
            if(array_key_exists('application_at_upper_limit',$data))$query = $query->where('application','<=',$data['application_at_upper_limit']);
            if(array_key_exists('expiration_on',$data))$query = $query->where('expiration_on','<=',$data['expiration_on']);
            if(array_key_exists('page',$data)){
                return $query->paginate(config('api.common.paginate_item_num.supporter_application_documents'));
            }else{
                return $query->get();
            }
        }else{
            $query = SupporterApplicationDocument::find($data['application_document_id']);
            return $query;
        }
        return $query->get();
    }
}
