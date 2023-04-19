<?php

namespace App\UseCases\Admin\Supporter\Result\Review;

use App\Models\ResultReview;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return ResultReview::create($data);
    }
}
