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
            'titles' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'titles.required' => 'Поле title является обязательным.',
            'titles.array' => 'Поле title должно быть массивом.',
        ];
    }
}
