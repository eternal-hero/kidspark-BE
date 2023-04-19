<?php
namespace App\UseCases\Admin\Guardian\GuardianNotice;

use App\Models\GuardianNotice;


class DeleteUseCase
{
    public function __invoke($guardian_user_id, $id = null)
    {
        $guardian_notice = GuardianNotice::where('guardian_user_id',$guardian_user_id);
        if(!is_null($id))$guardian_notice = $guardian_notice->where('id',$id);
        return $guardian_notice->delete();
    }
}