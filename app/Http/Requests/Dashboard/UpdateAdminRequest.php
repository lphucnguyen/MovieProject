<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
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
            'name' => 'required|string|max:20|min:5',
            'email' => [
                'required',
                'email',
                'string',
                Rule::unique('admins')->ignore($this->uuid, 'id')
            ],
            'avatar' => 'nullable|image',
            'password' => 'nullable|string|confirmed|min:6',
            'permissions' => 'required|min:1'
        ];
    }
}
