<?php

namespace App\UseCases\Supporter\Job;

use App\Models\Job;

class indexUseCase
{
    public function __invoke($supporter_user_id, $request)
    {
        $name = $request['name'];
        $job = Job::with([
            'guardianUser',
            'jobRequest'
        ])
        ->where('supporter_user_id', $supporter_user_id)
        ->when(isset($request['status']), function($query) use ($request) {
            return $query->where('status', '=', ($request['status']));
        })
        ->whereHas('guardianUser', function ($query) use ($request) {
            $query->when(isset($request['name']), function ($subQuery) use ($request) {
                $name = $request['name'];
                return $subQuery->where('last_name','LIKE',"%{$name}%")
                ->orWhere('first_name','LIKE',"%{$name}%")
                ->orWhereRaw('CONCAT(last_name,"",first_name) LIKE ?',"%{$name}%");
            });
        })
        ->whereHas('jobRequest', function($query) use ($request) {
            $first_date = date("Y-m-d", strtotime('first day of ' . $request['month']));
            $last_date = date("Y-m-d", strtotime('last day of ' . $request['month']));
            $query->whereBetween('support_date_on',[$first_date,$last_date])
            ->when(!isset($request['is_single']), function ($subQuery) {
                return $subQuery->where('request_content', '>=', 2);
            })
            ->when(isset($request['is_single']) && $request['is_single'] == 1, function ($subQuery) {
                return $subQuery->where('request_content', '=', 2);
            })
            ->when(isset($request['is_single']) && $request['is_single'] == 0, function ($subQuery) {
                return $subQuery->where('request_content', '=', 3);
            });
        })
        ->get();
        return $job;
    }
}
