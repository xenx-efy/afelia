<?php

namespace App\Http\Requests\Composition;

use App\Http\Requests\BaseRequest;

/**
 * @property string title
 * @property int composerId
 * @property array tags
 */
class StoreCompositionRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            'title' => 'required|min:3',
            'composerId' => 'required|numeric',
            'tags.*' => 'numeric',
        ];
    }

    public function messages():array
    {
        return [
            'title.required' => 'Поле title является обязательным.',
            'title.min' => 'Название произведения не должно быть меньше трех символов.',
            'composer_id.numeric' => 'Id композитора должно быть числом.',
            'composer_id.required' => 'Id композитора - обязательный параметр.',
            'tags.*.numeric' => 'Необходимо чтобы теги были числами.',
        ];
    }
}
