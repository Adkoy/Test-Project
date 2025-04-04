<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            'errors' => $validator->errors(),
            'success' => false,
        ], 400));
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(response([
            'errors' => [
                'You are not allowed to do this action.',
            ],
            'success' => false,
        ], 403));
    }
}
