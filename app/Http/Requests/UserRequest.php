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
            'user_uuid' => ['nullable', 'uuid', 'sometimes', 'exists:users'],
            'email' => ['nullable', 'email', 'exists:users'],
            'card_number' => ['nullable', 'digits:15', 'exists:bank_cards'],
            'level' => ['nullable', 'integer', 'between:1,4'],
            'card_number_count' => ['nullable', 'integer', 'min:0'],
        ];


    }
}
