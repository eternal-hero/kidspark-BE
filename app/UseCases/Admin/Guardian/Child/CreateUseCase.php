<?php
namespace App\UseCases\Admin\Guardian\Child;

use App\Models\Child;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return Child::create($data);
    }
}