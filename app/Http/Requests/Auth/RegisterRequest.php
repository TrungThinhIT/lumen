<?php

namespace App\Http\Requests\Auth;

use Anik\Form\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'id' => 'required|string|max:15|min:4|alpha_dash|unique:users',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users',
            'password' => 'required|string|min:6',
            'name' => 'required|string|min:6',
            'phone' => 'required|string|min:9',
        ];
    }
}
