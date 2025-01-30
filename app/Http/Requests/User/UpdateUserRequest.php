<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|max:255|regex:/^[\pL\s]+$/u',
            'lastname' => 'required|max:255|regex:/^[\pL\s]+$/u',
            'username' => [
                'required',
                'max:255',
                'regex:/^[\pL\pN]+$/u',
                Rule::unique('users', 'username')->ignore($this->route('user')->id)
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->route('user')->id)
            ],
            'password' => 'nullable|string',
            'roles' => 'required|array|min:1',
            'roles.*' => 'in:super-admin,employee',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Check if "none" is selected in the roles array
            if (in_array('none', $this->roles)) {
                // Add a custom error message if "none" is selected
                $validator->errors()->add('roles', 'Ju lutemi zgjidhni një rol të vlefshëm.');
            }
        });
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Emri i Perdoruesit është i detyrueshëm.',
            'name.regex' => 'Emri i Perdoruesit mund të përmbajë vetëm shkronja dhe hapësira.',
            'lastname.required' => 'Mbiemri i Perdoruesit është i detyrueshëm.',
            'lastname.regex' => 'Mbiemri i Perdoruesit mund të përmbajë vetëm shkronja dhe hapësira.',
            'username.required' => 'Username është i detyrueshëm.',
            'username.string' => 'Username i Perdoruesit duhet te jete nje string',
            'username.regex' => 'Username mund të përmbajë vetëm shkronja dhe numra.',
            'username.max' => 'Username mund të ketë maksimum 255 karaktere.',
            'username.unique' => 'Ky username është tashmë i regjistruar. Ju lutem zgjidhni një tjetër.',
            'email.required' => 'Email-i është i detyrueshëm.',
            'email.email' => 'Ju lutemi shkruani një email të vlefshëm.',
            'email.unique' => 'Ky email është tashmë i regjistruar. Ju lutem zgjidhni një tjetër.',
            'password.required' => 'Fjalëkalimi është i detyrueshëm.',
            'password.string' => 'Fjalëkalimi duhet të jetë një string.',
            'roles.required' => 'Ju lutemi zgjidhni një rol.',
            'roles.in' => 'Ju lutemi zgjidhni një rol të vlefshëm.',
        ];
    }
}
