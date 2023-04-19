<?php

namespace App\Http\Controllers\Admin\Supporter;

use App\Http\Requests\Admin\Supporter\SupportRequests\StoreRequest;
use App\Http\Requests\Admin\Supporter\SupportRequests\UpdateRequest;
use App\UseCases\Admin\Supporter\Support\CreateUseCase;
use App\UseCases\Admin\Supporter\Support\SearchUseCase;
use App\UseCases\Admin\Supporter\Support\UpdateUseCase;
use App\UseCases\Admin\Supporter\Support\DeleteUseCase;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    public function index($supporter_user_id)
    {
        $supporterSupport = (new SearchUseCase)($supporter_user_id);
        return response()->ok($supporterSupport);
    }

    public function store(StoreRequest $request, $supporter_user_id)
    {
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
            'is_handicapped_children_support' => $request->is_handicapped_children_support ?? 0,
            'is_handicapped_children_approval' => $request->is_handicapped_children_approval,
            'lesson_support_bitflag' => $request->lesson_support_bitflag,
            'is_cabinet_office_discount_coupon' => $request->is_cabinet_office_discount_coupon,
        ];
        $supporterSupport = (new CreateUseCase)($create);
        return response()->ok($supporterSupport);
    }

    public function update(UpdateRequest $request, $supporter_user_id)
    {
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
            'is_handicapped_children_support' => $request->is_handicapped_children_support ?? 0,
            'is_handicapped_children_approval' => $request->is_handicapped_children_approval,
            'lesson_support_bitflag' => $request->lesson_support_bitflag,
            'is_cabinet_office_discount_coupon' => $request->is_cabinet_office_discount_coupon,
        ];
        $supporterSupport = (new UpdateUseCase)($update, $supporter_user_id);
        return response()->ok($supporterSupport);
    }

    public function delete($supporter_user_id)
    {
        (new DeleteUseCase)($supporter_user_id);
        return response()->ok();
    }
}
