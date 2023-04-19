<?php
namespace App\UseCases\Supporter\Housekeeping\Support;

use App\Models\HousekeepingSupport;


class DeleteUseCase
{
    public function __invoke($supporter_user_id)
    {
        $housekeeping_support = HousekeepingSupport::where('supporter_user_id',$supporter_user_id);
        return $housekeeping_support->delete();
    }
}