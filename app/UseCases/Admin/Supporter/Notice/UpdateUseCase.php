<?php
namespace App\UseCases\Admin\Supporter\Notice;

use App\Models\SupporterNotice;


class UpdateUseCase
{
    public function __invoke($supporter_user_id,array $data)
    {
        return SupporterNotice::where('supporter_user_id',$supporter_user_id)->update($data);
    }
}