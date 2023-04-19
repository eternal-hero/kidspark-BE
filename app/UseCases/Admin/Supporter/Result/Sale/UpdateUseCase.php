<?php

namespace App\UseCases\Admin\Supporter\Result\Sale;

use App\Models\ResultSale;


class UpdateUseCase
{
    public function __invoke($job_id, array $data)
    {
        return ResultSale::where('job_id', $job_id)->update($data);
    }
}
