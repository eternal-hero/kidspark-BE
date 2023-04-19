<?php

namespace App\Http\Controllers\Admin\Guardian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UseCases\Admin\Guardian\User as UserUseCase;
use App\Http\Requests\Admin\Guardian\UserRequests as UserRequests;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
Use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(UserRequests\IndexRequest $request, UserUseCase\IndexUseCase $IndexUC)
    {
        $post_data = $request->validated();
        $guardian_users = $IndexUC($post_data);
        $guardian_users = $guardian_users ? $guardian_users->map(function($row){
            $row = $row->only(array_merge(['id'],config('api.guardian.user_param.list')));
            if($row['children']){
                $row['children'] = $row['children']->toArray();
                $age = [];
                foreach($row['children'] as $child){
                    $child['birthday'] = str_replace('-','',$child['birthday']);
                    $age[] = floor((date('Ymd') - $child['birthday']) / 10000)."歳";
                }
                $row['children'] = implode(",",$age);
            }
            if($row['guardianProfile']){
                $row['guardianProfile'] = $row['guardianProfile']->toArray();
                $row['near_station'] = $row['guardianProfile']['near_line']."線 ".$row['guardianProfile']['near_station']."駅";
            }else{
                $row['near_station'] = '';
            }
            unset($row['guardianProfile']);
            return $row; 
        }) : $guardian_users;
        if($request->page) $guardian_users = $this->paginate($guardian_users,config('api.common.paginate_item_num.guardian_users'),$request->page);
        return response()->ok($guardian_users);
    }

    public function store(UserRequests\StoreRequest $request,UserUseCase\CreateUseCase $createUC)
    {
        $create = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'first_kana' => $request->first_kana,
            'last_kana' => $request->last_kana,
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'relation' => $request->relation,
            'birthday' => $request->birthday,
            'post_code' => $request->post_code,
            'prefecture' => $request->prefecture,
            'municipality' => $request->municipality,
            'street_name' => $request->street_name,
            'building' => $request->building,
            'contact_phone_number' => $request->contact_phone_number,
            'mail_address' => $request->mail_address,
            'password' => $request->password,
            'workspace' => $request->workspace,
            'family_structure' => $request->family_structure,
            'is_pets' => $request->is_pets,
            'housing_type' => $request->housing_type,
            'is_camera' => $request->is_camera,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone_number' => $request->emergency_contact_phone_number,
            'emergency_contact_relation' => $request->emergency_contact_relation,
            'status' => $request->status
        ];
        $create['password'] = Hash::make($create['password']);
        $guardian_users = $createUC($create);
        return response()->created();
    }

    public function show(UserUseCase\SearchUseCase $searchUC, $id)
    {
        $guardian_users = $searchUC($id);
        $guardian_users = $guardian_users->only(array_merge(['id'],config('api.guardian.user_param.profile')));
        return response()->ok($guardian_users);
    }

    public function update(UserRequests\UpdateProfileRequest $request,UserUseCase\UpdateUseCase $updateUC, $id)
    {
        $update = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'first_kana' => $request->first_kana,
            'last_kana' => $request->last_kana,
            'nickname' => $request->nickname,
            'gender' => $request->gender,
            'relation' => $request->relation,
            'birthday' => $request->birthday,
            'post_code' => $request->post_code,
            'prefecture' => $request->prefecture,
            'municipality' => $request->municipality,
            'street_name' => $request->street_name,
            'building' => $request->building,
            'contact_phone_number' => $request->contact_phone_number,
            'mail_address' => $request->mail_address,
            'workspace' => $request->workspace,
            'family_structure' => $request->family_structure,
            'is_pets' => $request->is_pets,
            'housing_type' => $request->housing_type,
            'is_camera' => $request->is_camera,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone_number' => $request->emergency_contact_phone_number,
            'emergency_contact_relation' => $request->emergency_contact_relation,
            'status' => $request->status
        ];
        $guardian_users = $updateUC($id,$update);
        return response()->ok();
    }

    public function destroy(UserUseCase\DeleteUseCase $deleteUC, $id)
    {
        $guardian_users = $deleteUC($id);
        return response()->ok();
    }

    public function update_password(UserRequests\UpdatePasswordRequest $request,UserUseCase\UpdateUseCase $updateUC, $id)
    {
        $update = [
            'password' => Hash::make($request->password),
        ];
        $guardian_users = $updateUC($id,$update);
        return response()->ok();
    }

    private function paginate($items, $perPage = 50, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
