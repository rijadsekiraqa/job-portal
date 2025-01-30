<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name' => 'required|regex:/^[\pL\s]+$/u|string|max:255|unique:categories,name',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Emri i kategoris është i detyrueshëm.',
            'name.string' => 'Emri i kategoris duhet të jetë një string.',
            'name.regex' => 'Emri i kategoris mund të përmbajë vetëm shkronja dhe hapësira.',
            'name.unique' => 'Kjo kategori ekziston',
        ];
    }

    
}
