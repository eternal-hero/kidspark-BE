<?php
namespace App\UseCases\Supporter\Setting\Experience;

use App\Models\SupporterExperience;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        return SupporterExperience::create($data);
    }
}