<?php
namespace App\UseCases\Admin\Guardian\User;

use App\Models\GuardianUser;


class DeleteUseCase
{
    public function __invoke($id)
    {
        return GuardianUser::where('id',$id)->delete();
    }
}