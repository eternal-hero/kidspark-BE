<?php
namespace App\UseCases\Admin\Guardian\Child;

use App\Models\Child;


class SearchUseCase
{
    public function __invoke($guardian_user_id = null,$id = null)
    {
        if(!is_null($guardian_user_id)){
            $child = Child::where('guardian_user_id',$guardian_user_id);
            if(!is_null($id)) $child = $child->where('id',$id);
            return $child->get();
        }else{
            return Child::all();
        }
    }
}