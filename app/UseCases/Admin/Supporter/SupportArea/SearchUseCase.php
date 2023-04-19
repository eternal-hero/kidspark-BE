<?php

namespace App\UseCases\Admin\Supporter\SupportArea;

use App\Models\SupportArea;

class SearchUseCase
{
    public function __invoke($supporter_user_id, $support_area_id)
    {
        if (is_null($support_area_id)) {
            return SupportArea::where('supporter_user_id', $supporter_user_id)->get();
        }
        $supportArea = SupportArea::where('supporter_user_id', $supporter_user_id)->find($support_area_id);
        if (is_null($supportArea)) {
            abort(404, "Support area not found");
        }
        return $supportArea;
    }
}
