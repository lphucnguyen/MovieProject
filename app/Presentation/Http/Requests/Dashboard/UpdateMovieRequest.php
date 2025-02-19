<?php

namespace App\Presentation\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UpdateMovieRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:50',
                'min:1',
                Rule::unique('films')->ignore($this->name, 'name')
            ],
            'year' => 'required|string|min:4',
            'overview' => 'required|string',
            'background_cover' => ['required', 'string', function ($attribute, $value, $fail) {
                $parts = explode("/", $value);
                $file = implode('/', array_slice($parts, -2));

                if (!Storage::exists($file)) {
                    $fail(__("Background không tồn tại"));
                }
            }],
            'poster' => ['required', 'string', function ($attribute, $value, $fail) {
                $parts = explode("/", $value);
                $file = implode('/', array_slice($parts, -2));

                if (!Storage::exists($file)) {
                    $fail(__("Poster không tồn tại"));
                }
            }],
            'url' => 'required|array|min:1',
            'api_url' => 'required|array|min:1',
            'type_film' => 'required',
            'categories' => 'required|array|max:3|exists:categories,id',
            'actors' => 'required|array|max:10|exists:actors,id'
        ];
    }
}
