<?php

namespace App\Http\Controllers\Admin\Supporter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Supporter\BeneficiaryAccountRequests as BeneficiaryAccountRequests;
use App\UseCases\Admin\Supporter\BeneficiaryAccount\SearchUseCase as BeneficiaryAccountSearch;
use App\UseCases\Admin\Supporter\BeneficiaryAccount\DeleteUseCase as BeneficiaryAccountDelete;
use App\UseCases\Admin\Supporter\BeneficiaryAccount\UpdateUseCase as BeneficiaryAccountUpdate;
use App\UseCases\Admin\Supporter\BeneficiaryAccount\CreateUseCase as BeneficiaryAccountCreate;
use App\Libs\EncryptString;

class BeneficiaryAccountController extends Controller
{
    private $encryptTarget = [
        'bank_name',
        'branch_name',
        'account_number',
        'account_name'
    ];

    public function index($supporter_user_id)
    {
        $data = (new BeneficiaryAccountSearch)($supporter_user_id);
        $data = $data->toArray();
        return response()->ok(EncryptString::decriptData($data[0],$this->encryptTarget));
    }

    public function update(BeneficiaryAccountRequests\UpdateRequest $request, $supporter_user_id)
    {
        $update =[
            'bank_name' => $request->bank_name,
            'branch_name' => $request->branch_name,
            'account_type' => $request->account_type,
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
        ];
        $update = EncriptString::encriptData($update,$this->encryptTarget);
        $beneficiaryAccount = (new BeneficiaryAccountUpdate)($update, $supporter_user_id);
        return response()->ok($beneficiaryAccount);
    }

    public function show($supporter_user_id)
    {
        $beneficiaryAccount = (new BeneficiaryAccountSearch)($supporter_user_id);
        $beneficiaryAccount = $beneficiaryAccount->toArray();
        return response()->ok(EncriptString::decriptData($beneficiaryAccount[0],$this->encryptTarget));
    }

    public function store(BeneficiaryAccountRequests\StoreRequest $request, $supporter_user_id)
    {
        $create =[
            'supporter_user_id' => $supporter_user_id,
            'bank_name' => $request->bank_name,
            'branch_name' => $request->branch_name,
            'account_type' => $request->account_type,
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
        ];
        $create = EncriptString::encriptData($create);
        $data = (new BeneficiaryAccountCreate)($create);
        return response()->ok($data);
    }

    public function destroy($supporter_user_id)
    {
        (new BeneficiaryAccountDelete)($supporter_user_id);
        return response()->ok();
    }
}
