<?php
namespace App\UseCases\Admin\Guardian\ApplicationForm;

use App\Models\ApplicationForm;


class UpdateUseCase
{
    public function __invoke($guardian_user_id, $id,array $data)
    {
        return ApplicationForm::where('guardian_user_id',$guardian_user_id)->where('id',$id)->update($data);
    }
}