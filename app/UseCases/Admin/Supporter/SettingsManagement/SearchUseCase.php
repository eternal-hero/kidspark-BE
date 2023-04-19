<?php

namespace App\UseCases\Admin\Supporter\SettingsManagement;

use App\Models\SupporterSettingsManagement;

class SearchUseCase
{
    public function __invoke($id)
    {
        if (is_null($id)) {
            return SupporterSettingsManagement::all();
        }
        $setting = SupporterSettingsManagement::find($id);
        if (is_null($setting)) {
            abort(404, "Setting management not found");
        }
        return $setting;
    }
}
