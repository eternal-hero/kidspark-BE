<?php
namespace App\UseCases\Admin\Guardian\PublishApplication;

use App\Models\PublishApplication;


class UpdateUseCase
{
    public function __invoke($guardian_user_id, $id,array $data)
    {
        return PublishApplication::where('guardian_user_id',$guardian_user_id)->where('id',$id)->update($data);
    }
}