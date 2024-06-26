<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CategoryUpdateRequest extends FormRequest
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
            'name' => ['required', 'min:3'],
            'slug' => ['sometimes', 'nullable', 'unique:categories,slug,'.$this->category->id],
            'description' => ['sometimes', 'nullable', 'max:300'],
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
