<?php

namespace App\Http\Controllers\Guardians;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UseCases\Guardians\Child as ChildUseCase;
use App\Http\Requests\Guardians\ChildRequests as ChildRequests;
use Illuminate\Support\Facades\Auth;

class ChildController extends Controller
{
    public function index(ChildUseCase\SearchUseCase $searchUC)
    {
        $guardian_user_id = Auth::id();
        $children = $searchUC($guardian_user_id);
        if (sizeof($children)) {
            return response()->ok($children);
        } else {
            return response()->notFound('Children Not Found.');
        }
    }

    public function update(ChildRequests\UpdateRequest $request, ChildUseCase\UpdateUseCase $updateUC, $children_id)
    {
        $guardian_user_id = Auth::id();
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
        $children = $updateUC($guardian_user_id, $children_id, $update);
        if ($children) {
            return response()->ok();
        } else {
            return response()->notFound('Children Not Found.');
        }
    }
    public function store(ChildRequests\StoreRequest $request, ChildUseCase\CreateUseCase $createUC)
    {
        $guardian_user_id = Auth::id();
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

    public function update_all(Request $request, ChildUseCase\UpdateAllUseCase $updateAllUC){
        $guardian_user_id = Auth::id();
        $post_data =$request->except('guardian_user_id');
        foreach($post_data as $key => $data){
            $post_data[$key]['guardian_user_id'] = $guardian_user_id;
            unset($post_data[$key]['chronic_disease_checked']);
            unset($post_data[$key]['updated_at']);
            unset($post_data[$key]['created_at']);
        }
        $guardian = $updateAllUC($post_data,$guardian_user_id);
        return response()->ok();
    }
}
