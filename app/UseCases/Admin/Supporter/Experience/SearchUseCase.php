<?php
namespace App\UseCases\Admin\Supporter\Experience;

use App\Models\SupporterExperience;


class SearchUseCase
{
    public function __invoke($supporter_user_id = null)
    {
        if(!is_null($supporter_user_id)){
            $supporter_experience = SupporterExperience::where('supporter_user_id',$supporter_user_id);
            return $supporter_experience->get();
        }else{
            return SupporterExperience::all();
        }
    }
}