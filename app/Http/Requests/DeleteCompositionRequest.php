<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeleteCompositionRequest extends FormRequest
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

    /**
     * Overriding the standard validation error handling.
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'errors' => $validator->errors(),
        ],
            200));
    }

    /**
     * Overriding the standard authorization error handling.
     *
     * @throws AuthorizationException
     */
    protected function failedAuthorization()
    {
        throw new AuthorizationException("You need to be authorized.");
    }
}
