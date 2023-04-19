<?php
namespace App\UseCases\Admin\Guardian\Point;

use App\Models\Point;


class DeleteUseCase
{
    public function __invoke($guardian_user_id, $id = null)
    {
        $points = Point::where('guardian_user_id',$guardian_user_id);
        if(!is_null($id))$points = $points->where('id',$id);
        return $points->delete();
    }
}