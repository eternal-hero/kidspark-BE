<?php

namespace App\Http\Controllers\Admin\Supporter\Application\Detail;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\Application\Detail\HistoryRequests;
use App\UseCases\Admin\Supporter\Application\Detail\History\CreateUseCase;
use App\UseCases\Admin\Supporter\Application\Detail\History\DeleteUseCase;
use App\UseCases\Admin\Supporter\Application\Detail\History\StoreUseCase;

class HistoryController extends Controller
{
    public function index($application_detail_id)
    {
        $data = (new CreateUseCase)($application_detail_id);
        return response()->ok($data);
    }

    public function store(HistoryRequests\StoreRequest $request, $application_detail_id)
    {
        $data = (new StoreUseCase)($request->validated(), $application_detail_id);
        return response()->created();
    }

    public function destroy($application_detail_id)
    {
        (new DeleteUseCase)($application_detail_id);
        return response()->ok();
    }
}
