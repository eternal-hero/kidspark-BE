<?php
namespace App\UseCases\Admin\Supporter\Experience;

use App\Models\SupporterExperience;


class DeleteUseCase
{
    public function __invoke($supporter_user_id)
    {
        $supporter_experience = SupporterExperience::where('supporter_user_id',$supporter_user_id);
        return $supporter_experience->delete();
    }
}