<?php

namespace App\UseCases\Admin\Supporter\Application\Detail\Details;

use App\Models\SupporterApplicationDetail;
use Carbon\Carbon;

class UpdateUseCase
{
    public function __invoke($requestData, $supporter_user_id, $application_detail_id)
    {
        $appDetail = SupporterApplicationDetail::where('supporter_user_id', $supporter_user_id)
            ->where('id', $application_detail_id)
            ->first();
        if (is_null($appDetail)){
            abort(404, "Application detail not found");
        }
        $appDetail->fill($requestData);
        $appDetail->update_at = Carbon::now();
        $appDetail->save();
        return $appDetail;
    }
}
