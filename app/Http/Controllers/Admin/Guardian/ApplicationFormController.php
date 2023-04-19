<?php

namespace App\Http\Controllers\Admin\Guardian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UseCases\Admin\Guardian\ApplicationForm as ApplicationFormUseCase;
use App\Http\Requests\Admin\Guardian\ApplicationFormRequests as ApplicationFormRequests;

class ApplicationFormController extends Controller
{
    public function index(ApplicationFormRequests\IndexRequest $request, ApplicationFormUseCase\IndexUseCase $indexUC)
    {
        $post_data = $request->validated();
        if($request->page)$post_data = $post_data + ['page' => $request->page];
        $application_forms = $indexUC($post_data);
        return response()->ok($application_forms);
    }

    public function store(ApplicationFormRequests\StoreRequest $request,ApplicationFormUseCase\CreateUseCase $createUC, $guardian_user_id)
    {
        $create = [
            'guardian_user_id' => $guardian_user_id,
            'status' => $request->status,
            'memo' => $request->memo,
            'updated_at' => $request->updated_at,
            'subject' => $request->subject,
            'sender' => $request->sender,
            'member_id' => $request->member_id,
            'detail' => $request->detail,
            'file_path' => $request->file_path
        ];
        $application_forms = $createUC($create);
        return response()->created();
    }

    public function show(ApplicationFormUseCase\SearchUseCase $searchUC, $guardian_user_id, $id)
    {
        $application_forms = $searchUC($guardian_user_id,$id);
        return response()->ok($application_forms);
    }

    public function update(ApplicationFormRequests\UpdateRequest $request,ApplicationFormUseCase\UpdateUseCase $updateUC, $guardian_user_id, $id)
    {
        $update = [
            'status' => $request->status,
            'memo' => $request->memo,
            'updated_at' => $request->updated_at,
            'subject' => $request->subject,
            'sender' => $request->sender,
            'member_id' => $request->member_id,
            'detail' => $request->detail,
            'file_path' => $request->file_path
        ];
        $application_forms = $updateUC($guardian_user_id,$id,$update);
        return response()->ok();
    }

    public function destroy(ApplicationFormUseCase\DeleteUseCase $deleteUC, $guardian_user_id, $id)
    {
        $application_forms = $deleteUC($guardian_user_id,$id);
        return response()->ok();
    }
}
