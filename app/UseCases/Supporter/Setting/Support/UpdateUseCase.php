<?php

namespace App\UseCases\Supporter\Setting\Support;

use App\Models\SupporterSupport;

class UpdateUseCase
{
    public function __invoke($requestData, $supporter_user_id)
    {
        $supporterSupport = SupporterSupport::where('supporter_user_id', $supporter_user_id)->first();
        if (is_null($supporterSupport)) {
            abort(404, "Supporter support not found");
        }
        $supporterSupport->fill($requestData);
        $supporterSupport->save();
        return $supporterSupport;
    }
}
