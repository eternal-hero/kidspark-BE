<?php

namespace App\Http\Controllers\Admin\Supporter\Application\Detail;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\Application\Detail\DetailRequests as DetailRequests;
use App\UseCases\Admin\Supporter\Application\Detail\Details\SearchUseCase;
use App\UseCases\Admin\Supporter\Application\Detail\Details\StoreUseCase;
use App\UseCases\Admin\Supporter\Application\Detail\Details\UpdateUseCase;
use App\UseCases\Admin\Supporter\Application\Detail\Details\DeleteUseCase;

class DetailController extends Controller
{
    public function show(DetailRequests\ShowRequest $request)
    {
        $post_data = $request->validated();
        if($request->page)$post_data = $post_data + ['page' => $request->page];
        $data = (new SearchUseCase)($post_data);
        return response()->ok($data);
    }

    public function update(DetailRequests\UpdateRequest $request, $supporter_user_id, $application_detail_id)
    {
        $data = (new UpdateUseCase)($request->validated(), $supporter_user_id, $application_detail_id);
        return response()->ok($data);
    }

    public function store(DetailRequests\StoreRequest $request, $supporter_user_id)
    {
        $data = (new StoreUseCase)($request->validated(), $supporter_user_id);
        return response()->created($data);
    }

    public function destroy($supporter_user_id, $application_detail_id)
    {
        $data = (new DeleteUseCase)($supporter_user_id, $application_detail_id);
        return response()->ok($data);
    }
}
