<?php

namespace App\Http\Controllers\Admin\Supporter;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\Supporter\SupportAreaRequests\StoreRequest;
use App\Http\Requests\Admin\Supporter\SupportAreaRequests\UpdateRequest;
use App\UseCases\Admin\Supporter\SupportArea\SearchUseCase as SupportAreaSearch;
use App\UseCases\Admin\Supporter\SupportArea\StoreUseCase as SupportAreaStore;
use App\UseCases\Admin\Supporter\SupportArea\UpdateUseCase as SupportAreaUpdate;
use App\UseCases\Admin\Supporter\SupportArea\DeleteUseCase as SupportAreaDelete;
use App\UseCases\Admin\Supporter\SupportArea\UpdateAllUseCase as SupportAreaUpdateAll;
use App\Http\Controllers\Controller;

class SupportAreaController extends Controller
{
    public function index($supporter_user_id, $support_area_id = null)
    {
        $supportArea = (new SupportAreaSearch)($supporter_user_id, $support_area_id);
        return response()->ok($supportArea);
    }

    public function store(StoreRequest $request, $supporter_user_id)
    {
        $create = [
            'supporter_user_id' => $supporter_user_id,
            'prefecture' => $request->prefecture,
            'area' => $request->area
        ];
        $supportArea = (new SupportAreaStore)($create, $supporter_user_id);
        return response()->ok($supportArea);
    }

    public function update(UpdateRequest $request, $supporter_user_id, $support_area_id)
    {
        $update = [
            'supporter_user_id' => $supporter_user_id,
            'prefecture' => $request->prefecture,
            'area' => $request->area
        ];
        $supportArea = (new SupportAreaUpdate)($update, $supporter_user_id, $support_area_id);
        return response()->ok($supportArea);
    }

    public function delete($supporter_user_id, $support_area_id = null)
    {
        (new SupportAreaDelete)($supporter_user_id, $support_area_id);
        return response()->ok();
    }

    public function update_all(Request $request){
        $supporter_user_id = $request->supporter_user_id;
        $post_data = $request->except('supporter_user_id');
        $posts = [];
        foreach($post_data as $key => $data){
            $posts[] = [
                'id' => null,
                'supporter_user_id' => $supporter_user_id,
                'prefecture' => $data['prefecture'],
                'area' => $data['area'],
            ];          
        }
        $supportArea = (new SupportAreaUpdateAll)($posts,$supporter_user_id);
        return response()->ok();
    }
}
