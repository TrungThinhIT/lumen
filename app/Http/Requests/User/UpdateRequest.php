<?php

namespace App\Http\Requests\User;

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
            'email' => 'nullable|email:rfc,dns|max:255|unique:users,email,' . $this->id,
            'password' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
        ];
    }

    public function all($keys = null)
    {
        $data = parent::all($keys);
        unset($data['id']);
        return $data;
    }
}
