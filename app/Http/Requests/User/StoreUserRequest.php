<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class StoreUserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email:rfc,dns|unique:App\Models\User,email',
            'name' => 'required|string',
            'is_admin' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Электронная почта является обязательным параметром.',
            'email.email' => 'Поле должно соответствовать формату электронной почты.',
            'name.required' => 'Name является обязательным параметром.',
            'name.string' => 'Name должно быть строкой.',
            'is_admin.required' => 'is_admin является обязательным параметром.',
            'is_admin.boolean' => 'is_admin должно быть булевого типа (true, false, 1, 0, "1", "0")'
        ];
    }
}
