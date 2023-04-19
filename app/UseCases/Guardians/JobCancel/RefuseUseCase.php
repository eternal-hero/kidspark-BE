<?php

namespace App\UseCases\Guardians\JobCancel;

use App\Models\Job;
use App\Models\JobCancel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RefuseUseCase
{
    public function __invoke($job_id, $request)
    {
        $job = Job::where('id', $job_id)->first();
        $job['status'] = 103; //辞退
        $data = [
            'job_id' => $job->id,
            'applicant_type' => config('api.common.reviewer_type.guardian'),
            'applicant_id' => $job->guardian_user_id,
            'status' => 2, //辞退
            'reason' => $request->reason,
            'date' => Carbon::now(),
            'reason_detail' => $request->reason_detail,
            'fee' => 0, //辞退の場合、キャンセル料なし？
            'confimation_bitflag' => 0
        ];
        try {
            DB::beginTransaction();
            
            JobCancel::create($data);
            $job->save();
            
            DB::commit();
            return;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}
