<?php

namespace App\Http\Controllers\Admin\Guardian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UseCases\Admin\Guardian\Child as ChildUseCase;
use App\Http\Requests\Admin\Guardian\ChildRequests as ChildRequests;

class ChildController extends Controller
{
    public function index(ChildUseCase\SearchUseCase $searchUC, $guardian_user_id)
    {
        $children = $searchUC($guardian_user_id);
        return response()->ok($children);
    }

    public function store(ChildRequests\StoreRequest $request,ChildUseCase\CreateUseCase $createUC, $guardian_user_id)
    {
        $create = [
            'guardian_user_id' => $guardian_user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'first_kana' => $request->first_kana,
            'last_kana' => $request->last_kana,
            'gender' => $request->gender,
            'nickname' => $request->nickname,
            'birthday' => $request->birthday,
            'allergy' => $request->allergy,
            'chronic_disease' => $request->chronic_disease,
            'other' => $request->other
        ];
        $children = $createUC($create);
        return response()->created();
    }

    public function show(ChildUseCase\SearchUseCase $searchUC, $guardian_user_id, $id)
    {
        $children = $searchUC($guardian_user_id,$id);
        return response()->ok($children);
    }

    public function update(ChildRequests\UpdateRequest $request,ChildUseCase\UpdateUseCase $updateUC, $guardian_user_id, $id)
    {
        $update = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'first_kana' => $request->first_kana,
            'last_kana' => $request->last_kana,
            'gender' => $request->gender,
            'nickname' => $request->nickname,
            'birthday' => $request->birthday,
            'allergy' => $request->allergy,
            'chronic_disease' => $request->chronic_disease,
            'other' => $request->other
        ];
        $children = $updateUC($guardian_user_id,$id,$update);
        return response()->ok();
    }

    public function destroy(ChildUseCase\DeleteUseCase $deleteUC, $guardian_user_id, $id)
    {
        $children = $deleteUC($guardian_user_id,$id);
        return response()->ok();
    }
    
    public function update_all(Request $request, $guardian_id,ChildUseCase\UpdateAllUseCase $updateAllUC){
        $guardian_user_id = $guardian_id; 
        $post_data =$request->except('guardian_user_id');
        foreach($post_data as $key => $data){
            unset($post_data[$key]['chronic_disease_checked']);
            unset($post_data[$key]['updated_at']);
            unset($post_data[$key]['created_at']);         
        }
        $guardian = $updateAllUC($post_data,$guardian_user_id);
        return response()->ok();
    }
}
