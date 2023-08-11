<?php

namespace App\Http\Requests\role_permission;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRolePermissionRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'role' => ['required', 'integer', 'exists:roles,id'],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['accepted']
        ];
    }
}
