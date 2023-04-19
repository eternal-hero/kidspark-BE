<?php
namespace App\UseCases\Admin\Guardian\ApplicationForm;

use App\Models\ApplicationForm;


class IndexUseCase
{
    public function __invoke($data)
    {
        $application_forms = ApplicationForm::where('guardian_user_id',$data['guardian_id']);
        //!array_key_exists('application_detail_id',$data)
        if(array_key_exists('updated_at_lower_limit',$data)) $application_forms = $application_forms->where('updated_at','>=',$data['updated_at_lower_limit']);
        if(array_key_exists('updated_at_upper_limit',$data)) $application_forms = $application_forms->where('updated_at','<=',$data['updated_at_upper_limit']);
        if(array_key_exists('id',$data)) $application_forms = $application_forms->where('id',$data['id']);
        if(array_key_exists('status',$data)) $application_forms = $application_forms->where('status',$data['status']);
        if(array_key_exists('subject',$data)) $application_forms = $application_forms->where('subject',$data['subject']);
        if(array_key_exists('page',$data)){
            return $application_forms->paginate(config('api.common.paginate_item_num.application_forms'));    
        }else{
            return $application_forms->get();
        }
    }
}