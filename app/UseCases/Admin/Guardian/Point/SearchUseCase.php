<?php
namespace App\UseCases\Admin\Guardian\Point;

use App\Models\Point;


class SearchUseCase
{
    public function __invoke($guardian_user_id = null,$id = null)
    {
        if(!is_null($guardian_user_id)){
            $points = Point::where('guardian_user_id',$guardian_user_id);
            if(!is_null($id)) $points = $points->where('id',$id);
            return $points->get();
        }else{
            return Point::all();
        }
    }
}