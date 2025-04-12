<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'username' => 'required|regex:/^\S*$/|unique:users',
            'password' =>
                ['required',
                    Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()]
            ,
            'image' => 'nullable|image|mimes:png,jpg|max:1024'
        ];
    }

    public function messages(): array
    {
        return [
            'username.regex' => __('validation.no_spaces'),
            'image.max' => __('validation.max_size'),
            'password' => __('validation.password_rules'),
            'image.mimes' => __('validation.image'),

        ];
    }

}
