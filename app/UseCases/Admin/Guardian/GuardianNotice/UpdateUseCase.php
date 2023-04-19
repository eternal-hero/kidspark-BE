<?php
namespace App\UseCases\Admin\Guardian\GuardianNotice;

use App\Models\GuardianNotice;


class UpdateUseCase
{
    public function __invoke($guardian_user_id, $id,array $data)
    {
        return GuardianNotice::where('guardian_user_id',$guardian_user_id)->where('id',$id)->update($data);
    }
}