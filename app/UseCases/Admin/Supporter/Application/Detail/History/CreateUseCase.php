<?php

namespace App\UseCases\Admin\Supporter\Application\Detail\History;

use App\Models\SupporterApplicationHistory;

class CreateUseCase
{
    public function __invoke($application_detail_id)
    {
        return SupporterApplicationHistory::where('application_id', $application_detail_id)
            ->get();
    }
}
