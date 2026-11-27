<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'     => 'required|string|max:255',
            'slug'      => 'nullable |string|max:255|unique:categories,slug',
            'image'     => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'is_active' => 'nullable|boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'image.required' => 'Category image is required.',
            'image.image'    => 'File must be an image.',
            'image.mimes'    => 'Image must be jpg, jpeg, png or webp.',
            'image.max'      => 'Image size must not exceed 2MB.',
        ];
    }
}
