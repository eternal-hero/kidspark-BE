<?php

namespace App\Http\Controllers\Admin\Supporter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\WorkImageRequests as WorkImagesRequest;
use App\UseCases\Admin\Supporter\WorkImage\IndexUseCase;
use App\UseCases\Admin\Supporter\WorkImage\ShowUseCase;
use App\UseCases\Admin\Supporter\WorkImage\CreateUseCase;
use App\UseCases\Admin\Supporter\WorkImage\UpdateUseCase;
use App\UseCases\Admin\Supporter\WorkImage\DeleteUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkImageController extends Controller
{
    public function index($supporter_user_id)
    {
        return (new IndexUseCase)($supporter_user_id);
    }

    public function show($supporter_user_id, $works_image_id)
    {
        return (new ShowUseCase)($supporter_user_id, $works_image_id);
    }

    public function store(WorkImagesRequest\StoreRequest $request, CreateUseCase $createUC, $supporter_user_id)
    {
        $data = [
            'supporter_user_id' => $supporter_user_id,
            'display_status' => $request->display_status,
            'note' => $request->note,
            'category' => $request->category,
            'image_path' => $request->image_path, //64base?
            'image' => $request->image
        ];
        $supporter_works_image = $createUC($data, $request);

        return response()->created();
    }

    public function update(WorkImagesRequest\UpdateRequest $request, $supporter_user_id, $works_image_id)
    {
        (new UpdateUseCase)($request, $supporter_user_id, $works_image_id);
        return response()->ok();
    }

    public function destroy(DeleteUseCase $deleteUC, $supporter_user_id, $works_image_id = null)
    {
        $supporter_works_image = $deleteUC($supporter_user_id, $works_image_id);
        return response()->ok();
    }
}
