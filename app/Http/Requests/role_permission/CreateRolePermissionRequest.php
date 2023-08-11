<?php

namespace App\Http\Requests\role_permission;

use Illuminate\Foundation\Http\FormRequest;

class CreateRolePermissionRequest extends FormRequest
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
            'role' => ['required', 'string', 'unique:roles,name'],
            'status' => ['required', 'boolean'],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['accepted']
        ];
    }
}
