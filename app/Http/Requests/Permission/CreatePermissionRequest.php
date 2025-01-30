<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class CreatePermissionRequest extends FormRequest
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
            'name' => ['required','string','regex:/^[\pL\s]+$/u','unique:permissions,name'],
        ];
    }


    
    public function messages(): array
    {
        return [
            'name.required' => 'Emri i Lejes është i detyrueshëm.',
            'name.unique' => 'Kjo Leje është tashmë e regjistruar. Ju lutem zgjidhni një tjetër.',
            'name.regex' => 'Emri i Lejes mund të përmbajë vetëm shkronja dhe hapësira.',
        ];
    }
}
