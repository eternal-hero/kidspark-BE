<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Common\InoculationStatusRequests\StoreRequest;
use App\Http\Requests\Admin\Common\InoculationStatusRequests\UpdateRequest;
use App\UseCases\Admin\Common\InoculationStatus\SearchUseCase as InoculationSearch;
use App\UseCases\Admin\Common\InoculationStatus\CreateUseCase as InoculationStore;
use App\UseCases\Admin\Common\InoculationStatus\UpdateUseCase as InoculationUpdate;
use App\UseCases\Admin\Common\InoculationStatus\DeleteUseCase as InoculationDelete;

class InoculationStatusController extends Controller
{
    public function index($id = null)
    {
        $inoculations = (new InoculationSearch)($id);
        return response()->ok($inoculations);
    }

    public function store(StoreRequest $request)
    {
        $inoculation = (new InoculationStore)($request->all());
        return response()->ok($inoculation);
    }

    public function update(UpdateRequest $request, $id)
    {
        $inoculation = (new InoculationUpdate)($request->all(), $id);
        return response()->ok($inoculation);
    }

    public function destroy($id)
    {
        (new InoculationDelete)($id);
        return response()->ok();
    }
}


