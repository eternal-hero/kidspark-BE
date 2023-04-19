<?php

namespace App\UseCases\Admin\Supporter\Option;

use App\Models\SupporterOption;

class UpdateUseCase
{
    public function __invoke($data, $supporter_user_id, $option_id)
    {
        $option = SupporterOption::where("supporter_user_id", $supporter_user_id)
            ->where("id", $option_id)
            ->first();
        if (is_null($option)) {
            abort(404, "Supporter option not found");
        }
        return $option->update($data);
    }
}
