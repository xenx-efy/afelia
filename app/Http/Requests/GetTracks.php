<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class GetTracks extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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
                'required_with:sortType'
            ],
            'sortType' => [
                Rule::in(['asc', 'desc']),
                'required_with:sortBy'
            ]
        ];
    }

    public function messages()
    {
        return [
            'sortBy.in' => 'Сортировка может быть по title или по last_played полям.',
            'sortType.in' => 'Тип соритровки может быть asc или desc.',
            'sortType.required_with' => 'sortBy должен быть заполнен.',
            'sortBy.required_with' => 'sortType должен быть заполнен.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }
}
