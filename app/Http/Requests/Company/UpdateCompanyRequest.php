<?php

namespace App\Http\Requests\Company;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
                Rule::unique('companies', 'name')->ignore($this->route('company')->id ?? $this->route('company')),
            ],
            'description' => 'required|string|max:1000',
            'company_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (empty($this->user_id)) { // If no user is selected
                $validator->errors()->add('user_id', 'Ju lutemi zgjidhni një përdorues të vlefshëm.');
            }
        });
    }

    
    public function messages(): array
    {
        return [
            'name.required' => 'Emri i Kompanis është i detyrueshëm.',
            'name.string' => 'Emri i Kompanis duhet të jetë një string.',
            'name.regex' => 'Emri i Kompanis mund të përmbajë vetëm shkronja dhe hapësira.',
            'name.unique' => 'Emri i Kompanis duhet te jete unik',
            'description.required' => 'Pershkrimi i Kompanis është i detyrueshëm.',
            'company_image.required' => 'Fotoja e kompanisë është e detyrueshme.',
            'company_image.image' => 'File-i duhet të jetë një imazh.',
            'company_image.mimes' => 'Fotoja duhet të jetë në formatin jpeg, png, jpg, ose gif.',
            'company_image.max' => 'Fotoja nuk mund të jetë më e madhe se 2MB.',
            'user_id.required' => 'Ju lutem zgjidhni një përdorues.', // Add this message
            'user_id.exists' => 'Përdoruesi i zgjedhur nuk ekziston.', // Optional
        ];
    }
}
