<?php

namespace App\UseCases\Admin\Supporter\ChildbirthCare\Setting;

use App\Models\ChildbirthCareSetting;

class UpdateUseCase
{
    public function __invoke($supporter_user_id, array $data)
    {
        return ChildbirthCareSetting::where('supporter_user_id', $supporter_user_id)->update($data);
    }
}
