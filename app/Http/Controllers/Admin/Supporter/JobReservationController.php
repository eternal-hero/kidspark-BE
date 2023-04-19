<?php

namespace App\Http\Controllers\Admin\Supporter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\JobReservationRequests as JobReservationRequests;
use App\UseCases\Admin\Supporter\JobReservation\SearchUseCase as JobReservationSearch;
use App\UseCases\Admin\Supporter\JobReservation\DeleteUseCase as JobReservationDelete;
use App\UseCases\Admin\Supporter\JobReservation\UpdateUseCase as JobReservationUpdate;
use App\UseCases\Admin\Supporter\JobReservation\CreateUseCase as JobReservationCreate;

class JobReservationController extends Controller
{
    public function index($supporter_user_id)
    {
        $beneficiaryAccounts = (new JobReservationSearch)($supporter_user_id);
        return response()->ok($beneficiaryAccounts);
    }


    public function update(JobReservationRequests\UpdateRequest $request, $supporter_user_id)
    {
        $beneficiaryAccount = (new JobReservationUpdate)($request->all(), $supporter_user_id);
        return response()->ok($beneficiaryAccount);
    }

    public function show($supporter_user_id)
    {
        $beneficiaryAccount = (new JobReservationSearch)($supporter_user_id);
        return response()->ok($beneficiaryAccount);
    }

    public function store(JobReservationRequests\StoreRequest $request)
    {
        $data = (new JobReservationCreate())($request->all());
        return response()->ok($data);
    }

    public function destroy($supporter_user_id)
    {
        (new JobReservationDelete())($supporter_user_id);
        return response()->ok();
    }
}
