<?php

namespace App\Http\Controllers\Supporter\Application;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supporter\Application\DocumentRequests;
use App\UseCases\Supporter\Application\Document\CreateUseCase;
use App\UseCases\Supporter\Application\Document\SearchUseCase;
use App\UseCases\Supporter\Application\Document\UpdateUseCase;
use App\UseCases\Supporter\Application\Document\DeleteUseCase;
use Illuminate\Support\Facades\Auth;
use App\Models\SupporterApplicationDocument;

class DocumentController extends Controller
{
    public function index()
    {
        $data = SupporterApplicationDocument::where('supporter_user_id',Auth::id())->get();
        return response()->ok($data);
    }

    public function show(DocumentRequests\ShowRequest $request)
    {
        $post_data = $request->validated();
        if($request->page)$post_data = $post_data + ['page' => $request->page];
        $data = (new SearchUseCase)($post_data);
        return response()->ok($data);
    }

    public function store(DocumentRequests\StoreRequest $request)
    {
        $supporter_user_id = Auth::id();
        (new CreateUseCase)($request->validated(), $supporter_user_id);
        return response()->created();
    }

    public function update(DocumentRequests\UpdateRequest $request, $application_document_id)
    {
        $supporter_user_id = Auth::id();
        $appDocument = (new UpdateUseCase)($request->validated(), $supporter_user_id, $application_document_id);
        return response()->ok($appDocument);
    }

    public function destroy($application_document_id = null)
    {
        $supporter_user_id = Auth::id();
        (new DeleteUseCase)($supporter_user_id, $application_document_id);
        return response()->ok();
    }
}
