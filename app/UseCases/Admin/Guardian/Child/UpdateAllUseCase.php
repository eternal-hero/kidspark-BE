<?php

namespace App\UseCases\Admin\Guardian\Child;

use App\Models\Child;
use Illuminate\Support\Facades\DB;

class UpdateAllUseCase
{
    public function __invoke($post_data, $guardian_user_id)
    {
        $deletes = Child::whereNotIn('id', array_column(array_filter($post_data, function ($k) {
            if (isset($k['id']))
                return $k;
        }), 'id'))->where('guardian_user_id',$guardian_user_id);
        DB::beginTransaction();
        try {
            $delete_array = $deletes->delete();
            $update_array = Child::upsert($post_data, ['id']);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        return [$update_array, $delete_array];
    }
}