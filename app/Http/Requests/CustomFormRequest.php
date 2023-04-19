<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $res = response()->invalidRequestParameter(
            [
                'validation_error' => $validator->errors()
            ]
        );
        throw new HttpResponseException($res);
    }
}
