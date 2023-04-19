<?php

namespace App\Http\Controllers\Supporter\Setting;

use App\Http\Requests\Supporter\Setting\SupportRequests\StoreRequest;
use App\Http\Requests\Supporter\Setting\SupportRequests\UpdateRequest;
use App\UseCases\Supporter\Setting\Support\CreateUseCase;
use App\UseCases\Supporter\Setting\Support\SearchUseCase;
use App\UseCases\Supporter\Setting\Support\UpdateUseCase;
use App\UseCases\Supporter\Setting\Support\DeleteUseCase;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function index()
    {
        $supporter_user_id = Auth::id();
        $supporterSupport = (new SearchUseCase)($supporter_user_id);
        return response()->ok($supporterSupport);
    }

    public function store(StoreRequest $request)
    {
        $supporter_user_id = Auth::id();
        $create = [
            'settings_id' => $request->settings_id,
            'supporter_user_id' => $supporter_user_id,
            'shooting_support' => $request->shooting_support,
            'acceptance_condition' => $request->acceptance_condition,
            'transportation_support' => $request->transportation_support,
            'early_response_lower_limit' => $request->early_response_lower_limit,
            'early_response_upper_limit' => $request->early_response_upper_limit,
            'nighttime_lower_limit' => $request->nighttime_lower_limit,
            'nighttime_upper_limit' => $request->nighttime_upper_limit,
            'overnight_care_lower_limit' => $request->overnight_care_lower_limit,
            'overnight_care_upper_limit' => $request->overnight_care_upper_limit,
            'is_foreign_user_support' => $request->is_foreign_user_support,
            'is_sick_children_support' => $request->is_sick_children_support,
            'is_handicapped_children_approval' => $request->is_handicapped_children_approval,
            'is_handicapped_children_support' => $request->is_handicapped_children_support,
            'lesson_support_bitflag' => $request->lesson_support_bitflag,
            'is_cabinet_office_discount_coupon' => $request->is_cabinet_office_discount_coupon,
        ];
        $supporterSupport = (new CreateUseCase)($create);
        return response()->ok($supporterSupport);
    }

    public function update(UpdateRequest $request)
    {
        $supporter_user_id = Auth::id();
        $update = [
            'shooting_support' => $request->shooting_support,
            'acceptance_condition' => $request->acceptance_condition,
            'transportation_support' => $request->transportation_support,
            'early_response_lower_limit' => $request->early_response_lower_limit,
            'early_response_upper_limit' => $request->early_response_upper_limit,
            'nighttime_lower_limit' => $request->nighttime_lower_limit,
            'nighttime_upper_limit' => $request->nighttime_upper_limit,
            'overnight_care_lower_limit' => $request->overnight_care_lower_limit,
            'overnight_care_upper_limit' => $request->overnight_care_upper_limit,
            'is_foreign_user_support' => $request->is_foreign_user_support,
            'is_sick_children_support' => $request->is_sick_children_support,
            'is_handicapped_children_support' => $request->is_handicapped_children_support,
            'lesson_support_bitflag' => $request->lesson_support_bitflag,
            'is_cabinet_office_discount_coupon' => $request->is_cabinet_office_discount_coupon,
        ];
        $supporterSupport = (new UpdateUseCase)($update, $supporter_user_id);
        return response()->ok($supporterSupport);
    }

    public function delete()
    {
        $supporter_user_id = Auth::id();
        (new DeleteUseCase)($supporter_user_id);
        return response()->ok();
    }
}
