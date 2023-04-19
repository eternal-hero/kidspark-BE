<?php

namespace App\UseCases\Admin\Supporter\Result\Sale;

use App\Models\ResultSale;


class DeleteUseCase
{
    public function __invoke($job_id)
    {
        return ResultSale::where('job_id', $job_id)->delete();
    }
}
