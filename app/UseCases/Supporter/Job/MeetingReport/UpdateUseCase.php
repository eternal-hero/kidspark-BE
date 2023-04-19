<?php

namespace App\UseCases\Supporter\Job\MeetingReport;

use App\Models\CompletionReport;
use App\Models\Job;
use App\Models\JobRequest;
use App\Models\JobSupportRecord;
use App\Models\PreQuotation;
use App\Models\QuotationFeeItem;
use App\Models\ReportContent;
use App\Models\ReportFeeItem;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UpdateUseCase
{
    public function __invoke($request, $job_id)
    {
        
        try {
            DB::beginTransaction();
            
            $job = Job::where('id', $job_id)->first();
            $job['status'] = 7;
            $job->save();
            
            $quotation = PreQuotation::where('job_id',$job_id)->first();
            
            $start_at = new Carbon($request->support_start_at);
            $end_at = new Carbon($request->support_end_at);
            $support_time = $start_at->diffInMinutes($end_at) / 60;
            
            $job_request = JobRequest::where('job_id',$job_id)->first();
            $request_start_at = new Carbon($job_request->support_start_at);
            $request_end_at = new Carbon($job_request->support_end_at);
            $request_support_time = $request_start_at->diffInMinutes($request_end_at) / 60;
            
            $overtime = $request_support_time - $support_time;
            
            $total = 0;
            $basic_fee = QuotationFeeItem::where('quotation_id',$quotation->id)->where('item_type',0)->first();
            
            if($overtime === 0) {
                $total += $support_time * $basic_fee['fee'];
            } else if($overtime > 0) {
                $total += $request_support_time * $basic_fee['fee'];
                $total += $overtime * $basic_fee['fee'] * 1.2;
            }
            if($request->has('transportation')) $total += $request->transportation['fee'];
            
            $completion_report = CompletionReport::where('job_id',$job_id)->first();
            $completion_report_data = [
                'job_id' => $job_id,
                'start_at' => $request->support_start_at,
                'end_at' => $request->support_end_at,
                'total' => $total,
                'is_approval' => 0,
            ];
            $completion_report->fill($completion_report_data);
            $completion_report->save();

            if($request->has('transportation')) $this->saveReportFeeItems($request->transportation, $completion_report,2);

            $this->saveReportContents($request->meeting_contents, $completion_report, 1);
            if($request->has('message')) $this->saveReportContents($request->message, $completion_report, 4);

            $job_record = JobSupportRecord::where('job_id', $job_id)->first();
            $job_record['report_send_at'] = Carbon::now();
            $job_record->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
        return 0;
    }

    private function saveReportFeeItems($item, $report, $type)
    {
        $fee_data = [
            'report_id' => $report->id,
            'item_type' => $type,
            'fee' => $item['fee'],          
        ];
        if(array_key_exists('detail',$item)) $fee_data['detail'] = $item['detail'];

        $db_item = ReportFeeItem::where('report_id',$report->id)->where('item_type',$type)->first();
        if($db_item) {
            $db_item->fill($fee_data);
            $db_item->save();
        } else {
            ReportFeeItem::create($fee_data);
        }
    }
    
    private function saveReportContents($item, $report, $type)
    {
        $content_data = [
            'report_id' => $report->id,
            'contents_type' => $type,
            'contents_detail' => $item,
        ];

        $db_item = ReportContent::where('report_id',$report->id)->where('contents_type',$type)->first();
        if($db_item) {
            $db_item->fill($content_data);
            $db_item->save();
        } else {
            ReportContent::create($content_data);
        }
    }
}
