<?php

namespace App\Http\Controllers\Admin\Guardian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UseCases\Admin\Guardian\PublishApplication as PublishApplicationUseCase;
use App\Http\Requests\Admin\Guardian\PublishApplicationRequests as PublishApplicationRequests;

class PublishApplicationController extends Controller
{
    public function index(PublishApplicationUseCase\SearchUseCase $searchUC, $guardian_user_id)
    {
        $publish_applications = $searchUC($guardian_user_id);
        return response()->ok($publish_applications);
    }

    public function store(PublishApplicationRequests\StoreRequest $request,PublishApplicationUseCase\CreateUseCase $createUC, $guardian_user_id)
    {
        $create = [
            'guardian_user_id' => $guardian_user_id,
            'title' => $request->title,
            'type' => $request->type,
            'is_single' => $request->is_single,
            'childcare_on' => $request->childcare_on,
            'support_time_start' => $request->support_time_start,
            'support_time_end' => $request->support_time_end,
            'detail' => $request->detail,
            'fee_limit' => $request->fee_limit,
            'transportation_expenses_limit' => $request->transportation_expenses_limit,
            'place' => $request->place,
            'near_station' => $request->near_station,
            'period_at' => $request->period_at,
            'status' => $request->status
        ];
        $publish_applications = $createUC($create);
        return response()->created();
    }

    public function show(PublishApplicationUseCase\SearchUseCase $searchUC, $guardian_user_id, $id)
    {
        $publish_applications = $searchUC($guardian_user_id,$id);
        return response()->ok($publish_applications);
    }

    public function update(PublishApplicationRequests\UpdateRequest $request,PublishApplicationUseCase\UpdateUseCase $updateUC, $guardian_user_id, $id)
    {
        $update = [
            'title' => $request->title,
            'type' => $request->type,
            'is_single' => $request->is_single,
            'childcare_on' => $request->childcare_on,
            'support_time_start' => $request->support_time_start,
            'support_time_end' => $request->support_time_end,
            'detail' => $request->detail,
            'fee_limit' => $request->fee_limit,
            'transportation_expenses_limit' => $request->transportation_expenses_limit,
            'place' => $request->place,
            'near_station' => $request->near_station,
            'period_at' => $request->period_at,
            'status' => $request->status
        ];
        $publish_applications = $updateUC($guardian_user_id,$id,$update);
        return response()->ok();
    }

    public function destroy(PublishApplicationUseCase\DeleteUseCase $deleteUC, $guardian_user_id, $id)
    {
        $publish_applications = $deleteUC($guardian_user_id,$id);
        return response()->ok();
    }
}
