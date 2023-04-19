<?php

namespace App\UseCases\Guardians\GuardianProfileImage;

use App\Models\GuardianProfileImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateAllUseCase
{
    public function __invoke($post_data, $guardian_profiles_id)
    {
        $db_data = GuardianProfileImage::where('guardian_profiles_id',$guardian_profiles_id)->get();
        $check_param = ['image_path'];
        $insert_array = $this->array_diff_recursive($check_param,$post_data,$db_data->toArray());
        $delete_array = $this->array_diff_recursive($check_param,$db_data->toArray(),$post_data);
        $delete_id_array = array_column($delete_array,'id');
        $delete_image_path = GuardianProfileImage::whereIn('id',$delete_id_array)->get('image_path');
        DB::beginTransaction();
        try{
            $update = GuardianProfileImage::upsert($insert_array,['id']);
            $delete = GuardianProfileImage::destroy($delete_id_array);
            DB::commit();
            foreach($delete_image_path as $key => $delete_path) {
                Storage::delete('public/'.$delete_path);
            }
        } catch (\Exception $e){
            DB::rollback();
        }
        return;
    }
    private function array_diff_recursive($keys, $array1, ...$arrayn)
    {
        foreach ($arrayn as $arrayi) {
            $array1 = array_udiff($array1, $arrayi, function($a, $b) use ($keys){
                foreach ($keys as $key) {
                    $cmp = $a[$key] <=> $b[$key]; 
                    if ($cmp) return $cmp;
                }
                return $cmp;
            });
        }
        return $array1;
    }
}
