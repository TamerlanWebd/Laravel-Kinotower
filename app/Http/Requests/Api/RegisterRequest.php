<?php

namespace App\Http\Requests\Api;

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
            'fio' => 'required|string|max:150|min:2',
            'email' => 'required|email|max:50|unique:users,email',
            'password' => 'required|string|min:6',
            'birthday' => 'required|date',
            'gender_id' => 'required|exists:genders,id',
        ];
    }
}
