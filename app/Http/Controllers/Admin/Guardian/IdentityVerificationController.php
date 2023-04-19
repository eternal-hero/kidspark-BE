<?php

namespace App\Http\Controllers\Admin\Guardian;

use App\Http\Controllers\Controller;
use App\UseCases\Admin\Guardian\IdentityVerification as IdentityVerificationUseCase;
use App\Http\Requests\Admin\Guardian\IdentityVerificationRequests as IdentityVerificationRequests;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class IdentityVerificationController extends Controller
{
    public function index(IdentityVerificationUseCase\SearchUseCase $searchUC, $guardian_user_id)
    {
        $identity_verification = $searchUC($guardian_user_id);
        return response()->ok($identity_verification);
    }

    public function store(IdentityVerificationRequests\StoreRequest $request,IdentityVerificationUseCase\CreateUseCase $createUC, $guardian_user_id)
    {
        $create = [
            'guardian_user_id' => $guardian_user_id,
            'status' => $request->status,
            'memo' => $request->memo,
            'title' => $request->title,
            'request_at' => $request->request_at,
            'expiration_on' => $request->expiration_on,
            'additional_file_path' => $request->additional_file_path
        ];
        $identity_verification = $createUC($create);
        return response()->created();
    }

    public function show(IdentityVerificationUseCase\SearchUseCase $searchUC, $guardian_user_id, $id)
    {
        $identity_verification = $searchUC($guardian_user_id,$id);
        return response()->ok($identity_verification);
    }

    public function update(IdentityVerificationRequests\UpdateRequest $request,IdentityVerificationUseCase\UpdateUseCase $updateUC, $guardian_user_id,$id)
    {
        $update = [
            'status' => $request->status,
            'memo' => $request->memo,
            'title' => $request->title,
            'request_at' => $request->request_at,
            'expiration_on' => $request->expiration_on,
            'additional_file_path' => $request->additional_file_path
        ];
        $identity_verification = $updateUC($guardian_user_id,$id,$update);
        return response()->ok();
    }

    public function destroy(IdentityVerificationUseCase\DeleteUseCase $deleteUC, $guardian_user_id, $id)
    {
        $identity_verification = $deleteUC($guardian_user_id,$id);
        return response()->ok();
    }

    public function list(IdentityVerificationUseCase\IndexUseCase $indexUC,IdentityVerificationRequests\ListRequest $request){
        $search_condotion = $request->all();
        $identity_verifications = $indexUC($search_condotion);
        if($request->page){
            $identity_verifications = $this->paginate($identity_verifications,10,$request->page);
        }
        return response()->ok($identity_verifications);
    }
    private function paginate($items, $perPage = 50, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
