<?php

namespace App\Http\Controllers\Admin\Supporter\Result;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\Result\SaleRequests as Salerequests;
use App\UseCases\Admin\Supporter\Result\Sale\SearchUseCase;
use App\UseCases\Admin\Supporter\Result\Sale\CreateUseCase;
use App\UseCases\Admin\Supporter\Result\Sale\UpdateUseCase;
use App\UseCases\Admin\Supporter\Result\Sale\DeleteUseCase;

class SaleController extends Controller
{
    public function index(SearchUseCase $searchUC, $job_id)
    {
        $result_sale = $searchUC($job_id);
        return response()->ok($result_sale);
    }

    public function store(Salerequests\StoreRequest $request, CreateUseCase $createUC, $job_id)
    {
        $create = [
            'job_id' => $job_id,
            'support_at' => $request->support_at,
            'settlement_at' => $request->settlement_at,
            "content_type" => $request->content_type,
            'amount_total' => $request->amount_total,
        ];
        $result_sale = $createUC($create);
        return response()->created();
    }

    public function update(Salerequests\UpdateRequest $request, UpdateUseCase $updateUC, $job_id)
    {
        $update = [
            'support_at' => $request->support_at,
            'settlement_at' => $request->settlement_at,
            "content_type" => $request->content_type,
            'amount_total' => $request->amount_total,
        ];
        $result_sale = $updateUC($job_id, $update);
        return response()->ok();
    }

    public function destroy(DeleteUseCase $deleteUC, $job_id)
    {
        $result_sale = $deleteUC($job_id);
        return response()->ok();
    }
}
