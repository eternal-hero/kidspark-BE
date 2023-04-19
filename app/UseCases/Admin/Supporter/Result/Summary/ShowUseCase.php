<?php

namespace App\UseCases\Admin\Supporter\Result\Summary;

use App\Models\ResultSummary;


class ShowUseCase
{
    public function __invoke($supporter_user_id, $recode_date)
    {
        $result_summary = ResultSummary::where('supporter_user_id', $supporter_user_id)->where('record_on', $recode_date)->get();
        return $result_summary;
    }
}
