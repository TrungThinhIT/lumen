<?php

namespace App\Http\Requests\User;

use Anik\Form\FormRequest;

class CreateRequest extends FormRequest
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
            'id' => 'required|string|max:15|unique:users',
            'email' => 'required|email:rfc,dns|max:255|unique:users',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ];
    }
}
