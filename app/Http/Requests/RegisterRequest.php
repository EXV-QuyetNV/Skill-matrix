<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'email.required'  => 'Please enter the password!',
            'email.unique' => 'email already exists',
            'email.email' => 'Please enter correct email format',
            'password.min'  => 'Password must be at least 6 characters!',
            'password.required'  => 'Please enter the password!',
            'confirm_password.same'  => 'confirm password does not match password!',
            'confirm_password.required'  => 'Please enter the confirmPassword!',
        ];
    }
}
