<?php
namespace App\UseCases\Admin\Supporter\Application\Document;

use App\Models\SupporterApplicationDocument;


class IndexUseCase
{
    public function __invoke($search_condition)
    {
        $application_documents = SupporterApplicationDocument::with(['supporterUser:id,first_name,last_name,first_kana,last_kana']);
        if(isset($search_condition['request_at_from'])){
            $application_documents = $application_documents->where('application_at','>',$search_condition['request_at_from']);
        }
        if(isset($search_condition['request_at_to'])){
            $application_documents = $application_documents->where('application_at','<',$search_condition['request_at_to']);
        }
        if(isset($search_condition['file_id'])){
            $application_documents = $application_documents->where('file_id',$search_condition['file_id']);
        }
        if(isset($search_condition['status'])){
            $application_documents = $application_documents->where('status',$search_condition['status']);
        }
        if(isset($search_condition['category'])){
            $application_documents = $application_documents->where('category',$search_condition['category']);
        }
        if(isset($search_condition['supporter_info'])){
            $application_documents->whereHas('supporterUser',function ($query) use ($search_condition) {
                $query->where('id',$search_condition['supporter_info'])
                ->orWhere('first_name','LIKE',"%{$search_condition['supporter_info']}%")
                ->orWhere('first_kana','LIKE',"%{$search_condition['supporter_info']}%");
            });
        }
        if(isset($search_condition['expiration_on'])){
            $application_documents = $application_documents->where('expiration_on','<',$search_condition['expiration_on']);
        }
        return $application_documents->get();
    }
}
