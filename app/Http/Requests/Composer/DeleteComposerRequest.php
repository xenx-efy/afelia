<?php

namespace App\Http\Requests\Composer;

use App\Http\Requests\BaseRequest;

class DeleteComposerRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'composerId' => 'required|numeric'
        ];
    }


    public function messages()
    {
        return [
            'composerId.required' => 'Поле composerId является обязательным.',
            'composerId.numeric' => 'Поле composerId должно быть числового типа.',
        ];
    }
}
