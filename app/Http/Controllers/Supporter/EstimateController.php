<?php

namespace App\Http\Controllers\Supporter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UseCases\Supporter\Job\Estimate\CreateUseCase;
use App\UseCases\Supporter\Job\Estimate\UpdateUseCase;
use App\Http\Requests\Supporter\EstimateRequests as Estimate;
use App\Models\PreQuotation;

class EstimateController extends Controller
{
    public function store(Estimate\CreateRequest $request, $job_id)
    {
        (new CreateUseCase)($request,$job_id);
        return response()->created();
    }

    public function show($job_id) 
    {
        $estimate = PreQuotation::with('QuotationFeeItem')->where('job_id',$job_id)->first();
        return response()->ok($estimate);
    }

    public function update(Estimate\UpdateRequest $request, $job_id)
    {
        (new UpdateUseCase)($request,$job_id);
        return response()->ok();
    }
}
