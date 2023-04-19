<?php
namespace App\UseCases\Guardians\Child;

use App\Models\Child;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return Child::create($data);
    }
}