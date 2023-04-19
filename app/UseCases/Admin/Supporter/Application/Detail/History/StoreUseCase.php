<?php

namespace App\UseCases\Admin\Supporter\Application\Detail\History;

use App\Models\SupporterApplicationHistory;
use Carbon\Carbon;

class StoreUseCase
{
    public function __invoke($requestData, $application_detail_id)
    {
        $applicatioHistory = new SupporterApplicationHistory();
        $applicatioHistory->fill($requestData);
        $applicatioHistory->application_id = $application_detail_id;
        $applicatioHistory->update_at = Carbon::now();
        $applicatioHistory->save();
        return $applicatioHistory;
    }
}
