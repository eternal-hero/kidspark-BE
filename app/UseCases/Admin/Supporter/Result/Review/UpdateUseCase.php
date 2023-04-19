<?php

namespace App\UseCases\Admin\Supporter\Result\Review;

use App\Models\ResultReview;


class UpdateUseCase
{
    public function __invoke($job_id, array $data)
    {
        return ResultReview::where('job_id', $job_id)->update($data);
    }
}
