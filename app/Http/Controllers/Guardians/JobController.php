<?php

namespace App\Http\Controllers\Guardians;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\UseCases\Guardians\Job\IndexUseCase;
use App\UseCases\Guardians\Job\SearchUseCase;
use App\UseCases\Guardians\Job\CreateUseCase;
use App\UseCases\Guardians\JobCancel\RefuseUseCase;
use App\Http\Requests\Guardians\JobRequests\StoreRequest;
use App\Http\Requests\Guardians\JobRequests\RefuseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $guardian_user_id = Auth::id();
        $jobs = (new IndexUseCase)($guardian_user_id,$request);
        return response()->ok($jobs);
    }
    public function store(StoreRequest $request)
    {
        $guardian_user_id = Auth::id();
        try {
            $result = (new CreateUseCase)($guardian_user_id,$request);
            return $result;
        } catch (\Exception $e) {
            return response()->internalError($e->getMessage());
        }
    }
    public function search($job_id)
    {
        $job = (new SearchUseCase)($job_id);
        return response()->ok($job);
    }

    public function refuse(RefuseRequest $request, $job_id)
    {
        try {
            (new RefuseUseCase)($job_id, $request);
            return response()->ok();
        } catch(\Exception $e) {
            return response()->internalError($e->getMessage());
        }
    }
}
