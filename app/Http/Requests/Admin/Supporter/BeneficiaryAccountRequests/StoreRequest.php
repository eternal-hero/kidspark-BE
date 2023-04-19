<?php

namespace App\Http\Requests\Admin\Supporter\BeneficiaryAccountRequests;

use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends CustomFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [];
    }

    public function rules()
    {
        return [
            'bank_name' => 'required',
            'branch_name' => 'required',
            'account_type' => ['required', Rule::in([0, 1])],
            'account_number' => 'required|alpha_dash',
            'account_name' => 'required',
        ];
    }
}
