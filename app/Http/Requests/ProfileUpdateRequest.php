<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
        'first_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'image' => 'nullable|mimes:jpg,jpeg,png|max:2048', // Only validate if file is uploaded
        'password' => 'nullable|min:8',
        ];
    }
     public function messages()
    {
        return [
            'first_name.max' => 'First name should not be above 255',
            'last_name.max'  => 'Last name should not be above 255',
            'email.email'         => 'Please provide a valid email address',
            'image.max'         => 'image file should not be above 2 MB',
            'password.min'        => 'Password must be at least 8 characters',
        ];
    }
}
