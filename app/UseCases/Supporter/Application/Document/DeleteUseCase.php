<?php

namespace App\UseCases\Supporter\Application\Document;

use App\Models\SupporterApplicationDocument;

class DeleteUseCase
{
    public function __invoke($supporter_user_id, $application_document_id)
    {
        $query = SupporterApplicationDocument::where('supporter_user_id', $supporter_user_id);
        if (!is_null($application_document_id)) {
            $query->where('id', $application_document_id);
        }
        $query->delete();
    }
}
