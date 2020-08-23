<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateCompositionRequest extends FormRequest
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
            'title' => 'required|min:3',
            'composer_id' => 'required|numeric',
            'tags.*' => 'numeric',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле title является обязательным.',
            'title.min' => 'Название произведения не должно быть меньше трех символов.',
            'composer_id.numeric' => 'Id композитора должно быть числом.',
            'composer_id.required' => 'Id композитора - обязательный параметр.',
            'tags.*.numeric' => 'Необходимо чтобы теги были числами.',
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
