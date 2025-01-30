<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
                'regex:/^[\pL\s]+$/u',
                // Exclude the current role's name from the unique check
                'unique:roles,name,' . $this->route('role')->id
            ],
            'permission' => ['required', 'array'],
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Roli i Perdoruesit është i detyrueshëm.',
            'name.regex' => 'Roli i Perdoruesit mund të përmbajë vetëm shkronja dhe hapësira.',
            'name.unique' => 'Ky Rol është tashmë i regjistruar. Ju lutem zgjidhni një tjetër.',
            'permission.required' => 'Ju lutem zgjidhni të paktën një leje.',
            'permission.array' => 'Lejet duhet të jenë një listë.',
        ];
    }
}
