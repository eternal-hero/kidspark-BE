<?php

namespace App\UseCases\Admin\Supporter\Result\Review;

use App\Models\ResultReview;


class DeleteUseCase
{
    public function __invoke($job_id)
    {
        return ResultReview::where('job_id', $job_id)->delete();
    }
}
