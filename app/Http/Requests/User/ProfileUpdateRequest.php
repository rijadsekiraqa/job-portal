<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        $userId = $this->user()->id;  

        return [
            'name' => 'required|string|max:255|regex:/^[\pL\s]+$/u',
            'lastname' => 'required|string|max:255|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|max:255|unique:users,email,' . $userId,
            'username' => 'required|string|max:255|unique:users,username,' . $userId,
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Emri i Perdoruesit është i detyrueshëm.',
            'name.regex' => 'Emri i Perdoruesit mund të përmbajë vetëm shkronja dhe hapësira.',
            'lastname.required' => 'Mbiemri i Perdoruesit është i detyrueshëm.',
            'lastname.regex' => 'Mbiemri i Perdoruesit mund të përmbajë vetëm shkronja dhe hapësira.',
            'email.required' => 'Email-i është i detyrueshëm.',
            'email.email' => 'Ju lutemi shkruani një email të vlefshëm.',
            'email.unique' => 'Ky email është tashmë i regjistruar. Ju lutem zgjidhni një tjetër.',
            'username.required' => 'Username është i detyrueshëm.',
            'username.unique' => 'Ky username është tashmë i regjistruar. Ju lutem zgjidhni një tjetër.',
            
        ];
    }
}
