<?php

namespace App\UseCases\Supporter\Job\Estimate;

use App\Models\Job;
use App\Models\PreQuotation;
use App\Models\QuotationFeeItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UpdateUseCase
{
    public function __invoke($request,$job_id)
    {
        
        $start_at = new Carbon($request->support_start_at);
        $end_at = new Carbon($request->support_end_at);
        $support_time = $start_at->diffInMinutes($end_at) / 60;
        
        DB::beginTransaction();
        try {
            $pre_quotation = PreQuotation::where('job_id',$job_id)->first();
            $basic_fee = QuotationFeeItem::where('quotation_id',$pre_quotation->id)->where('item_type',0)->first();
            $option = QuotationFeeItem::where('quotation_id',$pre_quotation->id)->where('item_type',1)->first();
            $transportation = QuotationFeeItem::where('quotation_id',$pre_quotation->id)->where('item_type',2)->first();
            $discount = QuotationFeeItem::where('quotation_id',$pre_quotation->id)->where('item_type',3)->first();
            $commission_fee = QuotationFeeItem::where('quotation_id',$pre_quotation->id)->where('item_type',4)->first();
            
            $job = Job::where('id',$job_id)->first();
            $job['status'] = 2;
            $job->save();
            
            $total = $support_time * $request->basic_fee;
            $total += $request->commission_fee;
            if($request->has('option')) $total += $request->option['fee'];
            if($request->has('transportation')) $total += $request->transportation['fee'];
            if($request->has('discount')) $total -= $request->discount['fee'];
            
            $pre_quotation_data = [
                'job_id' => $job_id,
                'support_start_at' => $request->support_start_at,
                'support_end_at' => $request->support_end_at,
                'total' => $total,
                'is_approval' => 0,
            ];
            $pre_quotation->fill($pre_quotation_data);
            $pre_quotation->save();
            
            $basic_fee_data = [
                'quotation_id' => $pre_quotation->id,
                'item_type' => 0,
                'fee' => $request->basic_fee,
            ];
            $basic_fee->fill($basic_fee_data);
            $basic_fee->save();

            $commission_fee_data = [
                'quotation_id' => $pre_quotation->id,
                'item_type' => 0,
                'fee' => $request->commission_fee,
            ];
            $commission_fee->fill($commission_fee_data);
            $commission_fee->save();
            
            if($request->has('option')) {
                $this->quotaionSave($request->option,$option,1,$pre_quotation->id);
            } else {
                if($option) {
                    QuotationFeeItem::where('id',$option->id)->delete();
                }
            }
            if($request->has('transportation')) {
                $this->quotaionSave($request->transportation,$transportation,2,$pre_quotation->id);
            } else {
                if($transportation) {
                    QuotationFeeItem::where('id',$transportation->id)->delete();
                }
            }
            if($request->has('discount')) {
                $this->quotaionSave($request->discount,$discount,3,$pre_quotation->id);
            } else {
                if($discount) {
                    QuotationFeeItem::where('id',$discount->id)->delete();
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->internalError($e);
        }
    }

    private function quotaionSave($item,$db_item,$type,$pre_quotation_id)
    {
        $fee = [
            'quotation_id' => $pre_quotation_id,
            'item_type' => $type,
            'fee' => $item['fee'],
        ];
        if(array_key_exists('detail',$item)) $fee['detail'] = $item['detail'];
        if($db_item) {
            $db_item->fill($fee);
            $db_item->save();
        } else {
            QuotationFeeItem::create($fee);
        }
    }
}
