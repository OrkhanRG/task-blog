<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class NewsStoreRequest extends FormRequest
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
            'category_id' => ['required', 'numeric'],
            'slug' => ['sometimes', 'nullable', 'unique:news,slug'],
            'title' => ['required', 'min:3'],
            'description' => ['sometimes', 'nullable'],
            'short_description' => ['sometimes', 'nullable', 'max:300'],
            'image' => ['sometimes', 'nullable', 'image', 'mimes:png,jpg,webp,jpeg', 'max:2048']
        ];
    }

    public function prepareForValidation()
    {
        if (!$this->slug)
        {
            $this->merge([
                'slug' => Str::slug($this->slug)
            ]);
        }
    }
}
