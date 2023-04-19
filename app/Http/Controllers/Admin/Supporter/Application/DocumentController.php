<?php

namespace App\Http\Controllers\Admin\Supporter\Application;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\Application\DocumentRequests;
use App\Services\SupporterIdentityApplicationService;
use App\UseCases\Admin\Supporter\Application\Document\CreateUseCase;
use App\UseCases\Admin\Supporter\Application\Document\SearchUseCase;
use App\UseCases\Admin\Supporter\Application\Document\UpdateUseCase;
use App\UseCases\Admin\Supporter\Application\Document\DeleteUseCase;
use App\UseCases\Admin\Supporter\Application\Document\IndexUseCase;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;


class DocumentController extends Controller
{
    private SupporterIdentityApplicationService $applicationService;
    public function __construct(SupporterIdentityApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }
    public function index(Request $request, $supporter_id)
    {
        $data = $this->applicationService->getApplicationsBySupporterId($supporter_id, $request->all());
        return response()->okWithResource($data);
    }

    public function show($supporter_id, $application_id)
    {
        $data = $this->applicationService->findApplicationById($application_id, $supporter_id);
        return response()->okWithResource($data);
    }

    public function store(DocumentRequests\StoreRequest $request, $supporter_user_id)
    {
        (new CreateUseCase)($request->validated(), $supporter_user_id);
        return response()->created();
    }

    public function update(DocumentRequests\UpdateRequest $request, $supporter_user_id, $application_document_id)
    {
        $update = $request->validated();
        unset($update['application_at']);
        $appDocument = (new UpdateUseCase)($update, $supporter_user_id, $application_document_id);
        return response()->ok($appDocument);
    }

    public function destroy($supporter_user_id, $application_document_id = null)
    {
        (new DeleteUseCase)($supporter_user_id, $application_document_id);
        return response()->ok();
    }
    public function list(DocumentRequests\ListRequest $request){
        $search_condotion = $request->all();
        $application_documents = (new IndexUseCase)($search_condotion);
        if($request->page){
            $application_documents = $this->paginate($application_documents,10,$request->page);
        }
        return response()->ok($application_documents);
    }
    private function paginate($items, $perPage = 50, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function uploadFile(Request $request, $supporter_user_id)
    {
        $path = 'supporter/' . $supporter_user_id . '/identity-applications';
        $filePath = Storage::disk('public')->putFile($path, $request->file('file'));
        return response()->ok($filePath);
    }
}
