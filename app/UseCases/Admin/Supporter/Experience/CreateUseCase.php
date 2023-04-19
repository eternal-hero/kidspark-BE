<?php
namespace App\UseCases\Admin\Supporter\Experience;

use App\Models\SupporterExperience;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return SupporterExperience::create($data);
    }
}