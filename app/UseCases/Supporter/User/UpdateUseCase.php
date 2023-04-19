<?php

namespace App\UseCases\Supporter\User;

use App\Models\SupporterUser;
use Illuminate\Support\Facades\Hash;

class UpdateUseCase
{
    public function __invoke($requestData, $supporter_user_id)
    {
        $supporterUser = SupporterUser::where('id', $supporter_user_id)->first();
        if (is_null($supporterUser)) {
            abort(404, "Supporter user not found");
        }
        $supporterUser->fill($requestData);
        if (array_key_exists("password", $requestData)) {
            $supporterUser->password = Hash::make($requestData["password"]);
        }
        $supporterUser->save();
        return $supporterUser;
    }
}
