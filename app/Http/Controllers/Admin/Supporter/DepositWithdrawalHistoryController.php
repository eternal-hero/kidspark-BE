<?php

namespace App\Http\Controllers\Admin\Supporter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\DepositWithdrawalHistoryRequests as DepositWithdrawalHistoryRequests;
use App\UseCases\Admin\Supporter\DepositWithdrawalHistory\CreateUseCase as DWHCreate;
use App\UseCases\Admin\Supporter\DepositWithdrawalHistory\DeleteUseCase as DWHDelete;
use App\UseCases\Admin\Supporter\DepositWithdrawalHistory\SearchUseCase as DWHSearch;
use App\UseCases\Admin\Supporter\DepositWithdrawalHistory\UpdateUseCase as DWHUpdate;

class DepositWithdrawalHistoryController extends Controller
{
    public function show(DepositWithdrawalHistoryRequests\ShowRequest $request)
    {
        $post_data = $request->validated();
        $dwh = (new DWHSearch)($post_data);
        return response()->ok($dwh);
    }

    public function store(DepositWithdrawalHistoryRequests\StoreRequest $request)
    {
        $dwh = (new DWHCreate)($request->all());
        return response()->ok($dwh);
    }

    public function update(DepositWithdrawalHistoryRequests\UpdateRequest $request, $supporter_user_id, $deposit_withdrawal_id)
    {
        $dwh = (new DWHUpdate)($request->all(), $supporter_user_id, $deposit_withdrawal_id);
        return response()->ok($dwh);
    }

    public function destroy($supporter_user_id, $deposit_withdrawal_id = null)
    {
        (new DWHDelete)($supporter_user_id, $deposit_withdrawal_id);
        return response()->ok();
    }
}
