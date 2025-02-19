<?php

namespace App\Presentation\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'username' => 'required|string|max:20|min:3',
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users')->ignore($this->email, 'email'),
            ],
            'first_name' => 'required|string|max:15|min:3',
            'last_name' => 'required|string|max:15|min:3',
            'avatar' => ['required', 'string', function ($attribute, $value, $fail) {
                $parts = explode("/", $value);
                $file = implode('/', array_slice($parts, -2));

                if (!Storage::exists($file)) {
                    $fail(__("Avatar không tồn tại"));
                }
            }],
            'password' => 'nullable|string|confirmed|min:6',
        ];
    }
}
