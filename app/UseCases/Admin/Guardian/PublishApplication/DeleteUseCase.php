<?php
namespace App\UseCases\Admin\Guardian\PublishApplication;

use App\Models\PublishApplication;


class DeleteUseCase
{
    public function __invoke($guardian_user_id, $id = null)
    {
        $publish_applications = PublishApplication::where('guardian_user_id',$guardian_user_id);
        if(!is_null($id))$publish_applications = $publish_applications->where('id',$id);
        return $publish_applications->delete();
    }
}