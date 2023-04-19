<?php

namespace App\Http\Controllers\Supporter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supporter\WorkImageRequests as WorkImagesRequest;
use App\Models\SupporterUser;
use App\Models\SupporterWorksImage;
use App\UseCases\Supporter\WorkImage\ShowUseCase;
use App\UseCases\Supporter\WorkImage\CreateUseCase;
use App\UseCases\Supporter\WorkImage\UpdateUseCase;
use App\UseCases\Supporter\WorkImage\DeleteUseCase;
use App\UseCases\Supporter\WorkImage\UpdateAllUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkImageController extends Controller
{
    public function index()
    {
        $supporter_user_id = Auth::id();
        $supporter_works_images = SupporterWorksImage::where('supporter_user_id', $supporter_user_id)->get();
        return response()->ok($supporter_works_images);
    }

    public function show(WorkImagesRequest\ShowRequest $request, ShowUseCase $showUC)
    {
        $post_data = $request->validated();
        if ($request->page) $post_data = $post_data + ['page' => $request->page];
        $supporter_works_image = $showUC($post_data);
        return response()->ok($supporter_works_image);
    }

    public function store(WorkImagesRequest\StoreRequest $request, CreateUseCase $createUC)
    {
        $supporter_user_id = Auth::id();
        $data = [
            'supporter_user_id' => $supporter_user_id,
            'display_status' => $request->display_status,
            'note' => $request->note,
            'category' => $request->category,
            'image_path' => $request->image_path //64base?
        ];
        $supporter_works_image = $createUC($data);

        return response()->created();
    }

    public function update(WorkImagesRequest\UpdateRequest $request, UpdateUseCase $updateUC, $works_image_id)
    {
        $supporter_user_id = Auth::id();
        $data = [
            'display_status' => $request->display_status,
            'note' => $request->note,
            'category' => $request->category,
            'image_path' => $request->image_path
        ];
        $supporter_works_image = $updateUC($supporter_user_id, $works_image_id, $data);
        return response()->ok();
    }

    public function destroy(DeleteUseCase $deleteUC, $works_image_id = null)
    {
        $supporter_user_id = Auth::id();
        $supporter_works_image = $deleteUC($supporter_user_id, $works_image_id);
        return response()->ok();
    }

    public function update_all(Request $request)
    {
        (new UpdateAllUseCase)($request->all(), Auth::id());
        $data = SupporterWorksImage::where('supporter_user_id', Auth::id())->get();
        return response()->ok($data);
    }
}
