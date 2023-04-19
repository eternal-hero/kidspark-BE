<?php
namespace App\UseCases\Admin\Guardian\PublishApplication;

use App\Models\PublishApplication;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return PublishApplication::create($data);
    }
}