@extends('admin.layouts.app')

@section('title', 'General Settings')

@section('content')
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="panel p-6 max-w-3xl">
        @csrf
        @method('PUT')

        <div class="form-section">
            <div class="form-section-title">General</div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="field-label">Site name</label>
                    <input type="text" name="site_name" value="{{ old('site_name', $setting->site_name) }}" class="field-input">
                </div>
                <div>
                    <label class="field-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $setting->email) }}" class="field-input">
                </div>
                <div>
                    <label class="field-label">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $setting->phone) }}" class="field-input">
                </div>
                <div>
                    <label class="field-label">Phone (secondary)</label>
                    <input type="text" name="phone_secondary" value="{{ old('phone_secondary', $setting->phone_secondary) }}" class="field-input">
                </div>
                <div class="sm:col-span-2">
                    <label class="field-label">Address</label>
                    <textarea name="address" rows="2" class="field-input">{{ old('address', $setting->address) }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-section-title">Social links</div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="field-label">Facebook URL</label>
                    <input type="url" name="facebook_url" value="{{ old('facebook_url', $setting->facebook_url) }}" class="field-input">
                </div>
                <div>
                    <label class="field-label">Instagram URL</label>
                    <input type="url" name="instagram_url" value="{{ old('instagram_url', $setting->instagram_url) }}" class="field-input">
                </div>
                <div>
                    <label class="field-label">Twitter / X URL</label>
                    <input type="url" name="twitter_url" value="{{ old('twitter_url', $setting->twitter_url) }}" class="field-input">
                </div>
                <div>
                    <label class="field-label">YouTube URL</label>
                    <input type="url" name="youtube_url" value="{{ old('youtube_url', $setting->youtube_url) }}" class="field-input">
                </div>
                <div>
                    <label class="field-label">LinkedIn URL</label>
                    <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $setting->linkedin_url) }}" class="field-input">
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-section-title">WhatsApp chat widget</div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="field-label">WhatsApp number (with country code)</label>
                    <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $setting->whatsapp_number) }}" class="field-input">
                </div>
                <div class="sm:col-span-2">
                    <label class="field-label">Greeting message</label>
                    <textarea name="whatsapp_greeting" rows="2" class="field-input">{{ old('whatsapp_greeting', $setting->whatsapp_greeting) }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-section-title">Analytics</div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="field-label">Google Analytics code</label>
                    <input type="text" name="ga_code" value="{{ old('ga_code', $setting->ga_code) }}" class="field-input">
                </div>
                <div>
                    <label class="field-label">Google Tag Manager code</label>
                    <input type="text" name="gtm_code" value="{{ old('gtm_code', $setting->gtm_code) }}" class="field-input">
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-section-title">Homepage hero slider</div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                @foreach ([1, 2, 3] as $i)
                    <div>
                        <label class="field-label">Slide {{ $i }}</label>
                        @if ($setting->{'hero_image_'.$i})
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($setting->{'hero_image_'.$i}) }}" alt=""
                                 class="h-24 w-full object-cover mb-2" style="border-radius: var(--radius-sm); border: 1px solid var(--color-border);">
                        @endif
                        <input type="file" name="hero_image_{{ $i }}" accept="image/*" class="text-sm">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-section">
            <div class="form-section-title">SEO defaults</div>
            <div class="field-hint mb-3">Used as a fallback when a page, package, or blog post doesn't set its own meta title/description.</div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="field-label">Default meta title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $setting->meta_title) }}" class="field-input">
                </div>
                <div>
                    <label class="field-label">Default meta description</label>
                    <input type="text" name="meta_description" value="{{ old('meta_description', $setting->meta_description) }}" class="field-input">
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-section-title">Contact page map</div>
            <label class="field-label">Map embed (iframe / HTML)</label>
            <textarea name="map_embed" rows="3" class="field-input field-input-mono">{{ old('map_embed', $setting->map_embed) }}</textarea>
        </div>

        <div class="form-section">
            <button type="submit" class="btn btn-primary">
                Save settings
            </button>
        </div>
    </form>
@endsection
