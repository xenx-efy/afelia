<?php

namespace App\Http\Requests\Composer;

use App\Http\Requests\BaseRequest;

class StoreComposerRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'composerName' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'composerName.required' => 'Поле composerName является обязательным.',
            'composerName.string' => 'Поле composerName должы быть строкового типа.'
        ];
    }
}
