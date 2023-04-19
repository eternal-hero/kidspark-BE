<?php

namespace App\Http\Requests\Admin\Supporter\BeneficiaryAccountRequests;

use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends CustomFormRequest
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
            'account_type' => [Rule::in([0, 1])],
            'account_number' => 'alpha_dash',
        ];
    }
}
