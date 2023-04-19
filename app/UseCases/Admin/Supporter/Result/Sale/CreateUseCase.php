<?php

namespace App\UseCases\Admin\Supporter\Result\Sale;

use App\Models\ResultSale;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return ResultSale::create($data);
    }
}
