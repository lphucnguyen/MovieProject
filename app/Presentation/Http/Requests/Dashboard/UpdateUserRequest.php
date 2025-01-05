<?php

namespace App\Presentation\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:20|min:3',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users')->ignore($this->uuid, 'id'),
            ],
            'first_name' => 'required|string|max:15|min:3',
            'last_name' => 'required|string|max:15|min:3',
            'avatar' => 'image',
            'password' => 'nullable|string|confirmed|min:6',
        ];
    }
}
