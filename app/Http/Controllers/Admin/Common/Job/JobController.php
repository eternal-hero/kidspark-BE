<?php

namespace App\Http\Controllers\Admin\Common\Job;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Common\Job\JobRequests\ListRequest as ListRequest;
use App\UseCases\Admin\Common\Job\Job\ListUseCase as JobList;
use App\UseCases\Admin\Common\Job\Job\DetailUseCase as JobDetail;
use App\UseCases\Admin\Common\Job\Job\ReportUseCase as JobReport;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class JobController extends Controller
{
    public function list(ListRequest $request)
    {
        $post_data = $request->validated();
        $job_list = (new JobList)($post_data);
        if($request->page) $job_list = $this->paginate($job_list,config('api.common.paginate_item_num.jon_list'),$request->page);
        return response()->ok($job_list);
    }

    public function detail($job_id)
    {
        $job_detail = (new JobDetail)($job_id);
        return response()->ok($job_detail);
    }
    public function report($job_id)
    {
        $job_report = (new JobReport)($job_id);
        return response()->ok($job_report);
    }
    private function paginate($items, $perPage = 50, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
