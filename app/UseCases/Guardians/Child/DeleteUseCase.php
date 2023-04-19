<?php
namespace App\UseCases\Guardians\Child;

use App\Models\Child;


class DeleteUseCase
{
    public function __invoke($guardian_user_id, $id = null)
    {
        $child = Child::where('guardian_user_id',$guardian_user_id);
        if(!is_null($id))$child = $child->where('id',$id);
        return $child->delete();
    }
}