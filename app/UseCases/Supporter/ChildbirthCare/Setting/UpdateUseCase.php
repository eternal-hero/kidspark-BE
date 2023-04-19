<?php

namespace App\UseCases\Supporter\ChildbirthCare\Setting;

use App\Models\ChildbirthCareSetting;

class UpdateUseCase
{
    public function __invoke(array $data, $supporter_user_id)
    {
        return ChildbirthCareSetting::where('supporter_user_id', $supporter_user_id)->update($data);
    }
}
