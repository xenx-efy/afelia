<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class UpdateUserRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string',
            'email' => 'email:rfc,dns|unique:App\Models\User,email',
            'is_admin' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'Поле должно соответствовать формату электронной почты.',
            'name.string' => 'Name должно быть строкой.',
            'is_admin.boolean' => 'is_admin должно быть булевого типа (true, false, 1, 0, "1", "0")'
        ];
    }
}
