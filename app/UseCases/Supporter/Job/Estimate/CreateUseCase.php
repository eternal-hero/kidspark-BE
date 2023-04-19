<?php

namespace App\UseCases\Supporter\Job\Estimate;

use App\Models\Chat;
use App\Models\ChatRoom;
use App\Models\Job;
use App\Models\PreQuotation;
use App\Models\QuotationFeeItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CreateUseCase
{
    public function __invoke($request,$job_id)
    {
        $start_at = new Carbon($request->support_start_at);
        $end_at = new Carbon($request->support_end_at);
        $support_time = $start_at->diffInMinutes($end_at) / 60;
        
        DB::beginTransaction();
        try {
            $job = Job::where('id',$job_id)->first();
            $job['status'] = 2;
            $job->save();

            $chat_room = ChatRoom::where('job_id',$job_id)->first();
            $chat = [
                'chat_room_id' => $chat_room->id,
                'sender' => 0,
                'is_read' => 0,
                'job_status_change' => config('api.common.job_status_change.post_estimate')
            ];
            Chat::create($chat);
            
            $total = $support_time * $request->basic_fee;
            $total += $request->commission_fee;
            if($request->has('option')) $total += $request->option['fee'];
            if($request->has('transportation')) $total += $request->transportation['fee'];
            if($request->has('discount')) $total -= $request->discount['fee'];
            
            $data = [
                'job_id' => $job_id,
                'support_start_at' => $request->support_start_at,
                'support_end_at' => $request->support_end_at,
                'total' => $total,
                'is_approval' => 0,
            ];
            $quotation = PreQuotation::create($data);
            
            $basic_fee = [
                'quotation_id' => $quotation->id,
                'item_type' => 0,
                'fee' => $request->basic_fee,
            ];
            QuotationFeeItem::create($basic_fee);
            $commission_fee = [
                'quotation_id' => $quotation->id,
                'item_type' => 4,
                'fee' => $request->commission_fee,
            ];
            QuotationFeeItem::create($commission_fee);
            if($request->has('option')) {
                $fee = [
                    'quotation_id' => $quotation->id,
                    'item_type' => 1,
                    'fee' => $request->option['fee'],
                ];
                if(array_key_exists('detail',$request->option)) $fee['detail'] = $request->option['detail'];
                QuotationFeeItem::create($fee);
            }
            if($request->has('transportation')) {
                $fee = [
                    'quotation_id' => $quotation->id,
                    'item_type' => 2,
                    'fee' => $request->transportation['fee'],
                ];
                if(array_key_exists('detail',$request->transportation)) $fee['detail'] = $request->transportation['detail'];
                QuotationFeeItem::create($fee);
            }
            if($request->has('discount')) {
                $fee = [
                    'quotation_id' => $quotation->id,
                    'item_type' => 3,
                    'fee' => $request->discount['fee'],
                ];
                if(array_key_exists('detail',$request->discount)) $fee['detail'] = $request->discount['detail'];
                QuotationFeeItem::create($fee);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->internalError($e);
        }
    }
}
