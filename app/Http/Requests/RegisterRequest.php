<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'username'=>'unique:users',
            'password' => 'required|string|min:8|confirmed', // Assuming you'll use password confirmation
        ];
    }


      /**
     * Get custom error messages for specific validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'First name is required',
            'last_name.required'  => 'Last name is required',
            'email.required'      => 'Email address is required',
            
            'username.unique'=>'username is already taken',
            'email.email'         => 'Please provide a valid email address',
            'email.unique'        => 'This email address is already registered',
            'password.required'   => 'Password is required',
            'password.min'        => 'Password must be at least 8 characters',
        ];
    }

}
