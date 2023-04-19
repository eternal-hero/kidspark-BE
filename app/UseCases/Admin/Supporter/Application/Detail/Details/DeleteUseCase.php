<?php

namespace App\UseCases\Admin\Supporter\Application\Detail\Details;

use App\Models\SupporterApplicationDetail;

class DeleteUseCase
{
    public function __invoke($supporter_user_id, $application_detail_id)
    {
        $application_detail = SupporterApplicationDetail::where('supporter_user_id', $supporter_user_id)
            ->where('id', $application_detail_id)
            ->first();
        return $application_detail->delete();
    }
}
