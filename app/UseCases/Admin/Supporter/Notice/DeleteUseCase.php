<?php
namespace App\UseCases\Admin\Supporter\Notice;

use App\Models\SupporterNotice;


class DeleteUseCase
{
    public function __invoke($supporter_user_id)
    {
        $housekeeping_setting = SupporterNotice::where('supporter_user_id',$supporter_user_id);
        return $housekeeping_setting->delete();
    }
}