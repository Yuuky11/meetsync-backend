<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:150',
            'email' => 'required|email|unique:identities,email',
            'phone' => 'required|string|max:20|unique:identities,phone',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}