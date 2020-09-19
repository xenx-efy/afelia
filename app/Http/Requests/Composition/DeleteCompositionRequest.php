<?php

namespace App\Http\Requests\Composition;

use App\Http\Requests\BaseRequest;

class DeleteCompositionRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'trackId' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'trackId.required' => 'Поле trackId обязательно',
            'trackId.numeric' => 'Поле trackId должно быть числового типа.'
        ];
    }
}
