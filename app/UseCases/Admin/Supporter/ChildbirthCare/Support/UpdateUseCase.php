<?php

namespace App\UseCases\Admin\Supporter\ChildbirthCare\Support;

use App\Models\ChildbirthCareSupport;

class UpdateUseCase
{
    public function __invoke($requestData, $supporter_user_id)
    {
        return ChildbirthCareSupport::where('supporter_user_id', $supporter_user_id)->update($data);
    }
}
