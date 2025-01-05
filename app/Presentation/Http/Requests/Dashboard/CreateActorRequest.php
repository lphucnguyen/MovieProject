<?php

namespace App\Presentation\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateActorRequest extends FormRequest
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
            'name' => 'required|string|max:30|min:3|unique:actors',
            'dob' => 'required|date',
            'overview' => 'required|string',
            'biography' => 'required|string',
            'avatar' => 'required|image',
            'background_cover' => 'required|image',
        ];
    }
}
