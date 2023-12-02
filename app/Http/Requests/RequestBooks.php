<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestBooks extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:100|unique:books',
            'year' => 'required|integer',
            'author' => 'required|max:100',
            'summary' => 'required|max:100',
            'publisher' => 'required|max:100',
            'page_count' => 'required|integer',
            'read_page' => 'required|integer',
        ];
    }


    function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            'errors' => [
                'status' => 'fail',
                'message' => [
                    $validator->getMessageBag()
                ]
            ]
        ], 400));
    }
}
