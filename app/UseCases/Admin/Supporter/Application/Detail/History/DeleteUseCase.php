<?php

namespace App\UseCases\Admin\Supporter\Application\Detail\History;

use App\Models\SupporterApplicationHistory;

class DeleteUseCase
{
    public function __invoke($application_detail_id)
    {
        SupporterApplicationHistory::where('application_id', $application_detail_id)->delete();
    }
}
