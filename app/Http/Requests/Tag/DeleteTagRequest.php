<?php

namespace App\Http\Requests\Tag;

use App\Http\Requests\BaseRequest;

class DeleteTagRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tagId' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'tagId.required' => 'Поле tagId является обязательным.',
            'tagId.numeric' => 'Поле tagId должно быть числового типа.',
        ];
    }
}
