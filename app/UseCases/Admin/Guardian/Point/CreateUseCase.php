<?php
namespace App\UseCases\Admin\Guardian\Point;

use App\Models\Point;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return Point::create($data);
    }
}