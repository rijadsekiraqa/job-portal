<?php

namespace App\Http\Requests\City;

use Illuminate\Foundation\Http\FormRequest;

class CreateCityRequest extends FormRequest
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
            'name' => 'required|regex:/^[\pL\s]+$/u|string|max:255|unique:cities,name',

        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Emri i Qytetit është i detyrueshëm.',
            'name.string' => 'Emri i Qytetit duhet të jetë një string.',
            'name.regex' => 'Emri i Qytetit mund të përmbajë vetëm shkronja dhe hapësira.',
            'name.unique' => 'Ky Qytet është tashmë i regjistruar. Ju lutem shkruani një tjetër.',
        ];
    }

    
}
