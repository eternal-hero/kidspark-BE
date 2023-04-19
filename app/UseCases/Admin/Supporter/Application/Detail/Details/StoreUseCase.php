<?php

namespace App\UseCases\Admin\Supporter\Application\Detail\Details;

use App\Models\SupporterApplicationDetail;
use Carbon\Carbon;

class StoreUseCase
{
    public function __invoke($requestData, $supporter_user_id)
    {
        $appDetail = new SupporterApplicationDetail();
        $appDetail->fill($requestData);
        $appDetail->supporter_user_id = $supporter_user_id;
        $appDetail->update_at = Carbon::now();
        $appDetail->save();
        return $appDetail;
    }
}
