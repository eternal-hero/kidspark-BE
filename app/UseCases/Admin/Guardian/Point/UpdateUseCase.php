<?php
namespace App\UseCases\Admin\Guardian\Point;

use App\Models\Point;


class UpdateUseCase
{
    public function __invoke($guardian_user_id, $id,array $data)
    {
        return Point::where('guardian_user_id',$guardian_user_id)->where('id',$id)->update($data);
    }
}