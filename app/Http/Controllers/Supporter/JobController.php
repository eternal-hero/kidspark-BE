<?php

namespace App\Http\Controllers\Supporter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobCancel;
use Illuminate\Support\Facades\Auth;
use App\UseCases\Supporter\Job\IndexUseCase as JobIndex;
use App\UseCases\Supporter\Job\Detail\SearchUseCase as JobDetailSearch;
use App\Http\Requests\Supporter\JobCancelRequests\RefuseRequest;
use App\Models\Chat;
use App\Models\ChatRoom;
use App\Models\JobRequest;
use App\Models\JobSupportRecord;
use App\Models\SupporterOption;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $supporter_user_id = Auth::id();
        $jobs = (new JobIndex)($supporter_user_id,$request);
        return response()->ok($jobs);
    }

    public function detail($job_id)
    {
        $data = (new JobDetailSearch)($job_id);
        return response()->ok($data);
    }

    public function options($job_id)
    {
        $options = SupporterOption::whereHas('reserveOption', function ($query) use ($job_id) {
            $query->where('job_id',$job_id);
        })->get();
        return response()->ok($options);
    }

    public function refuse(RefuseRequest $request, $job_id)
    {
        $job = Job::where('id', $job_id)->first();
        $job['status'] = 103; //辞退
        $data = [
            'job_id' => $job->id,
            'applicant_type' => 0,
            'applicant_id' => $job->supporter_user_id,
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
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->internalError($e);
        }
        return response()->created();
    }

    public function cancel(RefuseRequest $request, $job_id)
    {
        $job = Job::where('id', $job_id)->first();
        $job['status'] = 102;
        $data = [
            'job_id' => $job->id,
            'applicant_type' => 0,
            'applicant_id' => $job->supporter_user_id,
            'status' => 0,
            'reason' => $request->reason,
            'date' => Carbon::now(),
            'reason_detail' => $request->reason_detail,
            'confimation_bitflag' => 6
        ];

        $job_request = JobRequest::where('job_id',$job->id)->first();
        $start_at = new Carbon($job_request->support_start_at);
        $now = Carbon::now();
        $penalty_time = 48;
        if($now->diffInHours($start_at) <= $penalty_time) {
            $data['fee'] = 5000;
        } else {
            $data['fee'] = 0;
        }

        try {
            DB::beginTransaction();
            
            JobCancel::create($data);
            $job->save();
            
            $chat_room = ChatRoom::where('job_id',$job_id)->first();
            $chat = [
                'chat_room_id' => $chat_room->id,
                'sender' => 0,
                'is_read' => 0,
                'job_status_change' => config('api.common.job_status_change.supporter_cancel')
            ];
            Chat::create($chat);
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->internalError($e);
        }
        return response()->created();
    }

    public function ready($job_id)
    {
        $job = Job::where('id', $job_id)->first();
        $job['status'] = 4;
        $job->save();
        $data = [
            'job_id' => $job_id,
            'support_preparation_at' => Carbon::now()
        ];
        JobSupportRecord::create($data);
        
        $chat_room = ChatRoom::where('job_id',$job_id)->first();
        $chat = [
            'chat_room_id' => $chat_room->id,
            'sender' => 0,
            'is_read' => 0,
            'job_status_change' => config('api.common.job_status_change.job_ready')
        ];
        Chat::create($chat);
        return response()->ok();
    }

    public function start($job_id)
    {
        $job = Job::where('id', $job_id)->first();
        $job['status'] = 5;
        $job->save();
        $job_record = JobSupportRecord::where('job_id', $job_id)->first();
        $job_record['support_start_at'] = Carbon::now();
        $job_record->save();
        $chat_room = ChatRoom::where('job_id',$job_id)->first();
        $chat = [
            'chat_room_id' => $chat_room->id,
            'sender' => 0,
            'is_read' => 0,
            'job_status_change' => config('api.common.job_status_change.job_start')
        ];
        Chat::create($chat);
        return response()->ok();
    }
    
    public function end($job_id)
    {
        $job = Job::where('id', $job_id)->first();
        $job['status'] = 6;
        $job->save();
        $job_record = JobSupportRecord::where('job_id', $job_id)->first();
        $job_record['support_end_at'] = Carbon::now();
        $job_record->save();
        $chat_room = ChatRoom::where('job_id',$job_id)->first();
        $chat = [
            'chat_room_id' => $chat_room->id,
            'sender' => 0,
            'is_read' => 0,
            'job_status_change' => config('api.common.job_status_change.job_end')
        ];
        Chat::create($chat);
        return response()->ok();
    }
}
