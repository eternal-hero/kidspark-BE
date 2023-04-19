<?php

namespace App\UseCases\Admin\Supporter\Result\Sale;

use App\Models\ResultSale;


class SearchUseCase
{
    public function __invoke($job_id)
    {   
        if (!is_null($job_id)) {
            return ResultSale::where('job_id', $job_id)->get();
        } else {
            return ResultSale::all();
        }
    }
}
