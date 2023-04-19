<?php
namespace App\UseCases\Admin\Guardian\Child;

use App\Models\Child;


class UpdateUseCase
{
    public function __invoke($guardian_user_id, $id,array $data)
    {
        return Child::where('guardian_user_id',$guardian_user_id)->where('id',$id)->update($data);
    }
}