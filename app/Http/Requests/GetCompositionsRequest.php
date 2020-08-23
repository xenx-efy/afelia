<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class GetCompositionsRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ],
            200));
    }

    /**
     * Cancel default redirect and return 404 code.
     *
     * @throws AuthorizationException
     */
    protected function failedAuthorization()
    {
        throw new AuthorizationException("You need to be authorized.");
    }
}
