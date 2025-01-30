<?php

namespace App\Http\Requests\Category;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
                Rule::unique('categories', 'name')->ignore($this->route('category')),
            ],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (empty($this->name)) { 
                $validator->errors()->add('name', 'Ju lutemi zgjidhni një përdorues të vlefshëm.');
            }
        });
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
