<?php

namespace App\Http\Controllers\Admin\Supporter;

use App\Http\Controllers\Controller;
use App\UseCases\Admin\Supporter\SettingsManagement\SearchUseCase;
use App\Models\SupporterSettingsManagement;

class SettingsManagementController extends Controller
{
    public function index($id = null)
    {
        $data = (new SearchUseCase)($id);
        return response()->ok($data);
    }
}
