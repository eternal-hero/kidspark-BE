<?php

namespace App\Services;

use App\Models\SupporterUser;

class SupporterUserService
{
    public function identificationInfo($supporter_user_id)
    {
        return SupporterUser::where('id', $supporter_user_id)
            ->with('supporterProfileImage:supporter_user_id,image_path')
            ->with('housekeepingSetting:supporter_user_id,is_housework')
            ->with('childbirthCareSettings:supporter_user_id,is_childbirth_care')
            ->with('sickChildCareSettins:supporter_user_id,is_sick_child_care')
            ->with('housekeepingSetting:supporter_user_id,is_housework')
            ->with('supporterSetting:supporter_user_id,is_supporter')
            ->first();
    }
}
