<?php

namespace App\UseCases\Supporter\Setting\Option;

use App\Models\SupporterOption;

class SearchUseCase
{
    public function __invoke($supporter_user_id, $option_id = null,$settings_id = null)
    {
        $query = SupporterOption::where('supporter_user_id', $supporter_user_id);
        if (!is_null($option_id)) {
            $query->where('id', $option_id);
        }
        if (!is_null($settings_id)) {
            $query->where('settings_id', $settings_id);
        }
        return $query->get();
    }
}
