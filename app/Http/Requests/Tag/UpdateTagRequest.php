<?php

namespace App\Http\Requests\Tag;

use App\Http\Requests\BaseRequest;

class UpdateTagRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tagId' => 'required|numeric',
            'title' => 'required|string'
        ];
    }


    public function messages()
    {
        return [
            'tagId.required' => 'Поле tagId является обязательным.',
            'tagId.numeric' => 'Поле tagId должно быть числового типа.',
            'title.required' => 'Поле title является обязательным.',
            'title.string' => 'Полея title должно быть строкового типа.'
        ];
    }
}
