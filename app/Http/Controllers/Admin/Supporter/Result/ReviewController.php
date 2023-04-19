<?php

namespace App\Http\Controllers\Admin\Supporter\Result;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\Result\ReviewRequests as ReviewRequests;
use App\UseCases\Admin\Supporter\Result\Review\SearchUseCase;
use App\UseCases\Admin\Supporter\Result\Review\CreateUseCase;
use App\UseCases\Admin\Supporter\Result\Review\UpdateUseCase;
use App\UseCases\Admin\Supporter\Result\Review\DeleteUseCase;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(SearchUseCase $searchUC, $job_id)
    {
        $result_review = $searchUC($job_id);
        return response()->ok($result_review);
    }

    public function store(ReviewRequests\StoreRequest $request, CreateUseCase $createUC, $job_id)
    {
        $create = [
            'job_id' => $job_id,
            'post_at' => $request->post_at,
            'is_publish' => $request->is_publish,
            'rating' => $request->rating,
        ];
        $result_review = $createUC($create);
        return response()->created();
    }

    public function update(ReviewRequests\UpdateRequest $request, UpdateUseCase $updateUC, $job_id)
    {
        $update = [
            'post_at' => $request->post_at,
            'is_publish' => $request->is_publish,
            'rating' => $request->rating,
        ];
        $result_review = $updateUC($job_id, $update);
        return response()->ok();
    }

    public function destroy(DeleteUseCase $deleteUC, $job_id)
    {
        $result_review = $deleteUC($job_id);
        return response()->ok();
    }
}
