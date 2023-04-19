<?php
namespace App\UseCases\Supporter\Setting\Experience;

use App\Models\SupporterExperience;


class UpdateUseCase
{
    public function __invoke($supporter_user_id,array $data)
    {
        return SupporterExperience::where('supporter_user_id',$supporter_user_id)->update($data);
    }
}