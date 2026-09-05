<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'reviewer_name' => ['required', 'string', 'max:255'],
            'reviewer_email' => ['required', 'email', 'max:255'],
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            'title' => ['nullable', 'string', 'max:255'],
            'comment' => ['required', 'string', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'rating.min' => 'Please select a star rating from 1 to 5.',
            'rating.max' => 'Rating must be 5 or less.',
            'comment.max' => 'Your review must be under 5000 characters.',
        ];
    }
}
