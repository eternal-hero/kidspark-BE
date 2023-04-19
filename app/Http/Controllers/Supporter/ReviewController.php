<?php

namespace App\Http\Controllers\Supporter;

use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $supporter_user_id = Auth::id();
        $reviews = Review::where('reviewer_id', $supporter_user_id)
            ->where('reviewer_type', 1)
            ->whereHas('job.jobRequest', function($query) use ($request) {
                $query->when(!isset($request['job_type']), function ($subQuery) {
                    return $subQuery->where('request_content', '>=', 2);
                })
                ->when(isset($request['job_type']) && $request['job_type'] == 0, function ($subQuery) { //ベビーシッター
                    return $subQuery->where('request_content', '>=', 2)->where('request_category', 0);
                })
                ->when(isset($request['job_type']) && $request['job_type'] == 1, function ($subQuery) { //家事代行
                    return $subQuery->where('request_content', '>=', 2)->where('request_category', 3);
                });
            })
            ->get();
        return response()->ok($reviews);
    }
}
