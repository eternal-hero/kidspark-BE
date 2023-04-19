<?php

namespace App\UseCases\Supporter\Job\Report;

use App\Models\Chat;
use App\Models\ChatRoom;
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

class CreateUseCase
{
    public function __invoke($request, $job_id)
    {
        try {
            DB::beginTransaction();
            
            $job = Job::where('id', $job_id)->first();
            $job['status'] = 7;
            $job->save();

            $chat_room = ChatRoom::where('job_id',$job_id)->first();
            $chat = [
                'chat_room_id' => $chat_room->id,
                'sender' => 0,
                'is_read' => 0,
                'job_status_change' => config('api.common.job_status_change.post_report')
            ];
            Chat::create($chat);
            
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
            $discount = QuotationFeeItem::where('quotation_id',$quotation->id)->where('item_type',3)->first();
            
            if($overtime === 0) {
                $total += $support_time * $basic_fee['fee'];
            } else if($overtime > 0) {
                $total += $request_support_time * $basic_fee['fee'];
                $total += $overtime * $basic_fee['fee'] * 1.2;
            }
            if($discount) $total -= $discount['fee'];
            if($request->has('option')) $total += $request->option['fee'];
            if($request->has('transportation')) $total += $request->transportation['fee'];
            
            $completion_report_data = [
                'job_id' => $job_id,
                'start_at' => $request->support_start_at,
                'end_at' => $request->support_end_at,
                'total' => $total,
                'is_approval' => 0,
            ];
            $completion_report = CompletionReport::create($completion_report_data);
            
            
            $this->saveReportFeeItems($basic_fee->toArray(), $completion_report, 0);
            if($discount) $this->saveReportFeeItems($discount->toArray(), $completion_report, 3);

            if($request->has('option')) $this->saveReportFeeItems($request->option, $completion_report,1);
            if($request->has('transportation')) $this->saveReportFeeItems($request->transportation, $completion_report,2);

            $this->saveReportContents($request->time_table, $completion_report, 1);
            $this->saveReportContents($request->child_appearance, $completion_report, 2);
            if($request->has('picture')) $this->saveReportContents($request->picture, $completion_report, 3);
            if($request->has('message')) $this->saveReportContents($request->message, $completion_report, 4);

            $review_data = [
                'job_id' => $job_id,
                'reviewer_id'  => $job['supporter_user_id'],
                'reviewer_type' => 1, //サポーター
                'icon' => $request->icon,
                'rating' => $request->rating,
                'review_content' => $request->review_content ?? null,
                'post_at' => Carbon::now(),
                'is_publish' => $request->is_publish
            ];
            Review::create($review_data);

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
        return ReportFeeItem::create($fee_data);
    }

    private function saveReportContents($item, $report, $type)
    {
        $content_data = [
            'report_id' => $report->id,
            'contents_type' => $type,
            'contents_detail' => $item,
        ];
        return ReportContent::create($content_data);
    }
}
