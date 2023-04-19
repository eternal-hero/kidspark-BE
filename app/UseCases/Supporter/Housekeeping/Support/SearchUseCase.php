<?php
namespace App\UseCases\Supporter\Housekeeping\Support;

use App\Models\HousekeepingSupport;


class SearchUseCase
{
    public function __invoke($supporter_user_id = null)
    {
        if(!is_null($supporter_user_id)){
            $housekeeping_support = HousekeepingSupport::where('supporter_user_id',$supporter_user_id);
            return $housekeeping_support->get();
        }else{
            return HousekeepingSupport::all();
        }
    }
}