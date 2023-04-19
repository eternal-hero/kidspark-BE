<?php

namespace App\Http\Controllers\Admin\Guardian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UseCases\Admin\Guardian\Point as PointUseCase;
use App\Http\Requests\Admin\Guardian\PointRequests as PointRequests;

class PointController extends Controller
{
    public function index(PointUseCase\SearchUseCase $searchUC, $guardian_user_id)
    {
        $points = $searchUC($guardian_user_id);
        return response()->ok($points);
    }

    public function store(PointRequests\StoreRequest $request,PointUseCase\CreateUseCase $createUC, $guardian_user_id)
    {
        $create = [
            'guardian_user_id' => $guardian_user_id,
            'job_reservation_id' => $request->job_reservation_id,
            'content' => $request->content,
            'point' => $request->point,
            'point_on' => $request->point_on
        ];
        $points = $createUC($create);
        return response()->created();
    }

    public function show(PointUseCase\SearchUseCase $searchUC,$guardian_user_id, $id)
    {
        $points = $searchUC($guardian_user_id,$id);
        return response()->ok($points);
    }

    public function update(PointRequests\UpdateRequest $request,PointUseCase\UpdateUseCase $updateUC, $guardian_user_id, $id)
    {
        $update = [
            'job_reservation_id' => $request->job_reservation_id,
            'content' => $request->content,
            'point' => $request->point,
            'point_on' => $request->point_on
        ];
        $points = $updateUC($guardian_user_id,$id,$update);
        return response()->ok();
    }

    public function destroy(PointUseCase\DeleteUseCase $deleteUC, $guardian_user_id, $id)
    {
        $points = $deleteUC($guardian_user_id,$id);
        return response()->ok();
    }
}
