<?php
namespace App\UseCases\Admin\Supporter\Notice;

use App\Models\SupporterNotice;


class SearchUseCase
{
    public function __invoke($supporter_user_id = null)
    {
        if(!is_null($supporter_user_id)){
            $housekeeping_setting = SupporterNotice::where('supporter_user_id',$supporter_user_id);
            return $housekeeping_setting->get();
        }else{
            return SupporterNotice::all();
        }
    }
}