<?php

namespace App\Http\Requests\Address;

use Anik\Form\FormRequest;

class UpdateRequest extends FormRequest
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
            'user_id' => 'nullable|exists:users,id',
            'ward_id' => 'nullable|string',
            'address' => 'nullable|string|max:255',
        ];
    }
}
