<?php

namespace App\UseCases\Supporter\Setting\Option;

use App\Models\SupporterOption;
use Illuminate\Support\Facades\DB;

class UpdateAllUseCase
{
    public function __invoke($post_data, $supporter_user_id)
    {
        $db_data = SupporterOption::where('supporter_user_id',$supporter_user_id)
            ->where('settings_id',$post_data[0]['settings_id'])
            ->get();
        $check_param = ['subject_type','option_content'];
        $insert_array = $this->array_diff_recursive($check_param,$post_data,$db_data->toArray());
        $delete_array = $this->array_diff_recursive($check_param,$db_data->toArray(),$post_data);
        $delete_id_array = array_column($delete_array,'id');
        DB::beginTransaction();
        try{
            $update = SupporterOption::upsert($insert_array,['id']);
            $delete = SupporterOption::destroy($delete_id_array);
            DB::commit();
        } catch (\Exception $e){
            DB::rollback();
        }
        return ['update'=>$update,'delete'=>$delete];
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
