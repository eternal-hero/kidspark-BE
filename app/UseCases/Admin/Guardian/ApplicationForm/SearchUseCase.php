<?php
namespace App\UseCases\Admin\Guardian\ApplicationForm;

use App\Models\ApplicationForm;


class SearchUseCase
{
    public function __invoke($guardian_user_id = null,$id = null)
    {
        if(!is_null($guardian_user_id)){
            $application_forms = ApplicationForm::where('guardian_user_id',$guardian_user_id);
            if(!is_null($id)) $application_forms = $application_forms->where('id',$id);
            return $application_forms->get();
        }else{
            return ApplicationForm::all();
        }
    }
}