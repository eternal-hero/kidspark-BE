<?php

namespace App\UseCases\Guardians\Child;

use App\Models\Child;


class SearchUseCase
{
    public function __invoke($guardian_user_id = null, $id = null)
    {
        if (!is_null($guardian_user_id)) {
            return $child = Child::where('guardian_user_id', $guardian_user_id)->get();
        } else {
            return Child::all();
        }
    }
}
