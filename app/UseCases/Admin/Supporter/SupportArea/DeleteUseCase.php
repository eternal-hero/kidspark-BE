<?php

namespace App\UseCases\Admin\Supporter\SupportArea;

class DeleteUseCase
{
    public function __invoke($supporter_user_id, $support_area_id)
    {
        $supportAreas = (new SearchUseCase)($supporter_user_id, $support_area_id);
        if (is_null($support_area_id)) {
            $supportAreas->each->delete();
        } else {
            $supportAreas->delete();
        }
    }
}
