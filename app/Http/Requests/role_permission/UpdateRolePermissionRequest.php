<?php

namespace App\Http\Requests\role_permission;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRolePermissionRequest extends FormRequest
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
            'role_id' => ['required', 'integer','exists:roles,id'],
            'role' => ['required', 'string'],
            'status' => ['required', 'boolean'],
            'permissions' => ['required', 'array'],
            'permissions.*' => ['accepted']
        ];
    }
}
