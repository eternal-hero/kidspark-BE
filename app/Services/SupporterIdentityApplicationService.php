<?php

namespace App\Services;

use App\Models\SupporterApplicationDocument;

class SupporterIdentityApplicationService
{
    public function getApplicationsBySupporterId($supporter_id, $query_params = [])
    {
        $data = SupporterApplicationDocument::where('supporter_user_id', $supporter_id);
        if (isset($query_params['expiration_on'])) {
            $data->where('expiration_on', '<=', $query_params['expiration_on']);
        }
        if (isset($query_params['file_id'])) {
            $data->where('file_id', '=', $query_params['file_id']);
        }
        if (isset($query_params['rangeDateEnd'])) {
            $data->where('application_at', '<=', $query_params['rangeDateEnd']);
        }
        if (isset($query_params['rangeDateStart'])) {
            $data->where('application_at', '>=', $query_params['rangeDateStart']);
        }
        if (isset($query_params['status'])) {
            $data->where('status', '=', $query_params['status']);
        }
        if (isset($query_params['category'])) {
            $data->where('status', '=', $query_params['category']);
        }
        $per_page = config('api.common.paginate_item_num.supporter_application_documents');
        return $data->paginate($per_page);
    }

    public function findApplicationById($application_id, $supporter_id = null)
    {
        $app = SupporterApplicationDocument::where('id', $application_id);
        if (!is_null($supporter_id)) {
            $app->where('supporter_user_id', $supporter_id);
        }
        return $app->firstOrFail();
    }
}
