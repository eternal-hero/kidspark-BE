<?php
namespace App\UseCases\Admin\Guardian\IdentityVerification;

use App\Models\IdentityVerification;


class IndexUseCase
{
    public function __invoke($search_condition)
    {
        $identity_verifications = IdentityVerification::with(['guardian_user:id,first_name,last_name,first_kana,last_kana']);
        if(isset($search_condition['request_at_from'])){
            $identity_verifications = $identity_verifications->where('request_at','>',$search_condition['request_at_from']);
        }
        if(isset($search_condition['request_at_to'])){
            $identity_verifications = $identity_verifications->where('request_at','<',$search_condition['request_at_to']);
        }
        if(isset($search_condition['file_id'])){
            $identity_verifications = $identity_verifications->where('id',$search_condition['file_id']);
        }
        if(isset($search_condition['status'])){
            $identity_verifications = $identity_verifications->where('status',$search_condition['status']);
        }
        if(isset($search_condition['user_info'])){
            $identity_verifications->whereHas('guardian_user',function ($query) use ($search_condition) {
                $query->where('id',$search_condition['user_info'])
                ->orWhere('first_name','LIKE',"%{$search_condition['user_info']}%")
                ->orWhere('first_kana','LIKE',"%{$search_condition['user_info']}%");
            });
        }
        if(isset($search_condition['expiration_on'])){
            $identity_verifications = $identity_verifications->where('expiration_on','<',$search_condition['expiration_on']);
        }
        return $identity_verifications->get();
    }
}
