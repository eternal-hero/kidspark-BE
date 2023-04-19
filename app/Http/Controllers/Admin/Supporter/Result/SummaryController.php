<?php

namespace App\Http\Controllers\Admin\Supporter\Result;

use App\Http\Controllers\Controller;
use App\UseCases\Admin\Supporter\Result\Summary\ShowUseCase;


class SummaryController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $supporter_user_id
     * @param  date $recode_date
     * @return \Illuminate\Http\Response
     */
    public function show(ShowUseCase $showUC, $supporter_user_id, $recode_date)
    {
        $result_summary = $showUC($supporter_user_id, $recode_date);
        return response()->ok($result_summary);
    }
}
