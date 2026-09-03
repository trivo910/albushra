@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
    <form method="POST" action="{{ route('admin.settings.update') }}" class="bg-white rounded-lg shadow p-6 space-y-8 max-w-3xl">
        @csrf
        @method('PUT')

        <div>
            <h2 class="text-base font-semibold mb-4">General</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Site Name</label>
                    <input type="text" name="site_name" value="{{ old('site_name', $setting->site_name) }}"
                           class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $setting->email) }}"
                           class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $setting->phone) }}"
                           class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Phone (Secondary)</label>
                    <input type="text" name="phone_secondary" value="{{ old('phone_secondary', $setting->phone_secondary) }}"
                           class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium mb-1">Address</label>
                    <textarea name="address" rows="2"
                              class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">{{ old('address', $setting->address) }}</textarea>
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-base font-semibold mb-4">Social Links</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Facebook URL</label>
                    <input type="url" name="facebook_url" value="{{ old('facebook_url', $setting->facebook_url) }}"
                           class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Instagram URL</label>
                    <input type="url" name="instagram_url" value="{{ old('instagram_url', $setting->instagram_url) }}"
                           class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Twitter / X URL</label>
                    <input type="url" name="twitter_url" value="{{ old('twitter_url', $setting->twitter_url) }}"
                           class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">YouTube URL</label>
                    <input type="url" name="youtube_url" value="{{ old('youtube_url', $setting->youtube_url) }}"
                           class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">LinkedIn URL</label>
                    <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $setting->linkedin_url) }}"
                           class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-base font-semibold mb-4">WhatsApp Chat Widget</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">WhatsApp Number (with country code)</label>
                    <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $setting->whatsapp_number) }}"
                           class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium mb-1">Greeting Message</label>
                    <textarea name="whatsapp_greeting" rows="2"
                              class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">{{ old('whatsapp_greeting', $setting->whatsapp_greeting) }}</textarea>
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-base font-semibold mb-4">Analytics</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Google Analytics Code</label>
                    <input type="text" name="ga_code" value="{{ old('ga_code', $setting->ga_code) }}"
                           class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Google Tag Manager Code</label>
                    <input type="text" name="gtm_code" value="{{ old('gtm_code', $setting->gtm_code) }}"
                           class="w-full rounded border-gray-300 focus:border-gray-500 focus:ring-gray-500">
                </div>
            </div>
        </div>

        <div>
            <button type="submit" class="bg-gray-900 text-white rounded px-5 py-2 text-sm font-medium hover:bg-gray-800">
                Save Settings
            </button>
        </div>
    </form>
@endsection
