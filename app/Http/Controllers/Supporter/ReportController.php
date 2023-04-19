<?php

namespace App\Http\Controllers\Supporter;

use App\Http\Requests\Supporter\ReportRequests as Report;
use App\Http\Requests\Supporter\MeetingReportRequests as MeetingReport;
use App\Http\Controllers\Controller;
use App\Models\CompletionReport;
use App\UseCases\Supporter\Job\Report\CreateUseCase;
use App\UseCases\Supporter\Job\Report\UpdateUseCase;
use App\UseCases\Supporter\Job\MeetingReport\CreateUseCase as MeetingCreateUseCase;
use App\UseCases\Supporter\Job\MeetingReport\UpdateUseCase as MeetingUpdateUseCase;

class ReportController extends Controller
{
    public function store(Report\StoreRequest $request, $job_id)
    {
        $result = (new CreateUseCase)($request, $job_id);
        if($result) {
            return response()->internalError($result);
        } else {
            return response()->ok();
        }
    }
    
    public function show($job_id)
    {
        $report = CompletionReport::with(['reportFeeItem','reportContent','job.review'])->where('job_id',$job_id)->first();
        return response()->ok($report);
    }
    
    public function update(Report\UpdateRequest $request, $job_id)
    {
        $result = (new UpdateUseCase)($request, $job_id);
        if($result) {
            return response()->internalError($result);
        } else {
            return response()->ok();
        }
    }

    public function meeting_store(MeetingReport\StoreRequest $request, $job_id)
    {
        $result = (new MeetingCreateUseCase)($request, $job_id);
        if($result) {
            return response()->internalError($result);
        } else {
            return response()->ok();
        }
    }
    
    public function meeting_show($job_id)
    {
        $report = CompletionReport::with(['reportFeeItem','reportContent'])->where('job_id',$job_id)->first();
        return response()->ok($report);
    }
    
    public function meeting_update(MeetingReport\UpdateRequest $request, $job_id)
    {
        $result = (new MeetingUpdateUseCase)($request, $job_id);
        if($result) {
            return response()->internalError($result);
        } else {
            return response()->ok();
        }
    }
}
