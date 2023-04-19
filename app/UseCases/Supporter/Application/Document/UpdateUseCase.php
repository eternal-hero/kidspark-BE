<?php

namespace App\UseCases\Supporter\Application\Document;

use App\Models\SupporterApplicationDocument;

class UpdateUseCase
{
    public function __invoke($requestData, $supporter_user_id, $application_document_id)
    {
        $appDocument = SupporterApplicationDocument::where('supporter_user_id', $supporter_user_id)
            ->firstWhere('id', $application_document_id);
        if (is_null($appDocument)) {
            abort(404, 'Application document not found');
        }
        $appDocument->fill($requestData);
        $appDocument->save();
        return $appDocument;
    }
}
