<?php
namespace App\UseCases\Guardians\User;

use App\Models\GuardianUser;


class DeleteUseCase
{
    public function __invoke($id)
    {
        return GuardianUser::where('id',$id)->delete();
    }
}