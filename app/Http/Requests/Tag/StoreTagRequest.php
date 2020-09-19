<?php

namespace App\Http\Requests\Tag;

use App\Http\Requests\BaseRequest;

class StoreTagRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле title является обязательным.',
            'title.string' => 'Поле title должно быть строкового типа.',
        ];
    }
}
