<?php

namespace App\UseCases\Admin\Supporter\Result\Review;

use App\Models\ResultReview;


class SearchUseCase
{
    public function __invoke($job_id = null)
    {
        if (!is_null($job_id)) {
            return ResultReview::where('job_id', $job_id)->get();
        } else {
            return ResultReview::all();
        }
    }
}
