<?php

namespace App\Http\Requests\user;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'exists:roles,id'],
            'email' => ['required', 'string', 'email', Rule::unique('users', 'email')],
            'mobile' => ['required', 'integer', 'digits:10'],
            'password' => ['required', 'confirmed'],
        ];
    }
}
