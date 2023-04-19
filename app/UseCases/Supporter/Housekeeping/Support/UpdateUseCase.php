<?php
namespace App\UseCases\Supporter\Housekeeping\Support;

use App\Models\HousekeepingSupport;


class UpdateUseCase
{
    public function __invoke($supporter_user_id,array $data)
    {
        return HousekeepingSupport::where('supporter_user_id',$supporter_user_id)->update($data);
    }
}