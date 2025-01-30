<?php

namespace App\Http\Requests\City;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\pL\s]+$/u',
                Rule::unique('cities', 'name')->ignore($this->route('city')),
            ],
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Emri i kategoris është i detyrueshëm.',
            'name.string' => 'Emri i kategoris duhet të jetë një string.',
            'name.regex' => 'Emri i kategoris mund të përmbajë vetëm shkronja dhe hapësira.',
            'name.unique' => 'Ky qytet ekziston tashmë.',
        ];
    }

    
}
