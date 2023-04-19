<?php
namespace App\UseCases\Admin\Guardian\User;

use App\Models\GuardianUser;


class SearchUseCase
{
    public function __invoke($id = null)
    {
        if(!is_null($id)){
            return GuardianUser::find($id);
        }else{
            return GuardianUser::all();
        }
    }
}