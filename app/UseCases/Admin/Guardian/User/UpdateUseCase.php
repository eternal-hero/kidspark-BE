<?php
namespace App\UseCases\Admin\Guardian\User;

use App\Models\GuardianUser;


class UpdateUseCase
{
    public function __invoke($id,array $data)
    {
        return GuardianUser::where('id',$id)->update($data);
    }
}