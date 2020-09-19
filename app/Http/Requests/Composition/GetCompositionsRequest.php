<?php

namespace App\Http\Requests\Composition;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class GetCompositionsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sortBy' => [
                Rule::in(['title', 'last_played']),
                'required_with:sortType',
            ],
            'sortType' => [
                Rule::in(['asc', 'desc']),
                'required_with:sortBy',
            ],
            'tags.*' => 'numeric',
            'title' => 'nullable|min:3',
        ];
    }

    /**
     * Custom messages for validation rules.
     *
     * @return array<string>
     */
    public function messages()
    {
        return [
            'sortBy.in' => 'Сортировка может быть по title или по last_played полям.',
            'sortType.in' => 'Тип соритровки может быть asc или desc.',
            'sortType.required_with' => 'sortBy должен быть заполнен.',
            'sortBy.required_with' => 'sortType должен быть заполнен.',
            'tags.*.numeric' => 'Необходимо чтобы теги были числами.',
            'title.min' => 'Название произведения не должно быть меньше трех символов.',
        ];
    }
}
