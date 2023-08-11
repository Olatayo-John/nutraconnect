<?php

namespace App\Http\Requests\setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            'site_name' => ['required', 'string', 'max:255'],
            'site_keywords' => ['required', 'string', 'max:255'],
            'site_description' => ['required', 'string', 'max:255'],
            'site_logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'mail_type' => ['required', 'string', 'max:255'],
            'mail_host' => ['required', 'string', 'max:255'],
            'mail_port' => ['required', 'string', 'max:255'],
            'mail_username' => ['required', 'string', 'email', 'max:255'],
            'mail_password' => ['required', 'string'],
            'about_us' => ['required', 'string'],
            'terms_condition' => ['required', 'string'],
            'privacy_policy' => ['required', 'string']
        ];
    }
}
