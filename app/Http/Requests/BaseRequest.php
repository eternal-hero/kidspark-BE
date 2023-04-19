<?php

namespace App\Http\Requests;


use App\Http\Requests\CustomFormRequest;
use Illuminate\Validation\Rule;

class BaseRequest extends CustomFormRequest
{
    public function validationData()
    {
        $params = $this->all();
        $route_params = $this->route()->parameters();

        return $params + $route_params;
    }
}
