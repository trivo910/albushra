<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:hajj,umrah'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'duration' => ['nullable', 'string', 'max:255'],
            'tour_type' => ['nullable', 'string', 'max:255'],
            'group_size' => ['nullable', 'string', 'max:255'],
            'languages' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'included' => ['nullable', 'array'],
            'included.*' => ['nullable', 'string', 'max:255'],
            'excluded' => ['nullable', 'array'],
            'excluded.*' => ['nullable', 'string', 'max:255'],
            'map_embed' => ['nullable', 'string'],
            'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['required', 'in:draft,published'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ];
    }
}
