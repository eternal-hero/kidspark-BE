<?php
namespace App\UseCases\Admin\Supporter\Notice;

use App\Models\SupporterNotice;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return SupporterNotice::create($data);
    }
}