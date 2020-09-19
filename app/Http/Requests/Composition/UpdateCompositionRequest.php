<?php

namespace App\Http\Requests\Composition;

use App\Http\Requests\BaseRequest;

class UpdateCompositionRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'trackId' => 'numeric',
            'title' => 'min:3|string|nullable',
            'composerId' => 'numeric',
            'tags.*' => 'numeric'
        ];
    }

    /**
     * Custom messages for request rules.
     *
     * @return array<string>
     */
    public function messages()
    {
        return [
            'trackId.numeric' => 'Поле trackId должно быть числового типа.',
            'title.min' => 'Поле title не может быть меньше 3х символов.',
            'title.string' => 'Поле title должно быть строкового типа.',
            'composerId.numeric' => 'Поле composerId должно быть числового типа.',
            'tags.*.numeric' => 'Необходимо чтобы теги были числами.'
        ];
    }
}
