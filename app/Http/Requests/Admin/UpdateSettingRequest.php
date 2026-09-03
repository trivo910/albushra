<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'site_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'phone_secondary' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'twitter_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'whatsapp_number' => ['nullable', 'string', 'max:20'],
            'whatsapp_greeting' => ['nullable', 'string'],
            'ga_code' => ['nullable', 'string', 'max:255'],
            'gtm_code' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'map_embed' => ['nullable', 'string'],
        ];
    }
}
