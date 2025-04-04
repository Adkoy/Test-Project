<?php

namespace App\Http\Requests;


class UserRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mobile' => 'required|numeric|exists:users,mobile',
        ];
    }
}
