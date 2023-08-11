<?php

namespace App\Http\Requests\profile;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string'],
            'profile' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'email' => ['required', 'string', 'email'],
            'mobile' => ['required', 'integer', 'digits:10'],
            'website' => ['nullable', 'string', 'url'],
            'location' => ['nullable', 'string'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'github' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'max:255'],
            'pinterest' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ];
    }
}
