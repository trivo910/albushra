@extends('admin.layouts.app')

@section('title', 'General Settings')

@section('content')
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="panel p-6 max-w-3xl">
        @csrf
        @method('PUT')

        <div class="form-section">
            <div class="form-section-title">Branding</div>
            <div class="field-hint mb-3">Upload the site logo. It appears in the public header and footer. Recommended: a transparent PNG or SVG, at least 240px wide.</div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="field-label">Site name</label>
                    <input type="text" name="site_name" value="{{ old('site_name', $setting->site_name) }}" class="field-input">
                </div>
                <div>
                    <label class="field-label">Site logo</label>
                    <input type="file" name="site_logo" accept="image/*" class="text-sm">
                    @if ($setting->site_logo)
                        <div class="mt-3 flex items-center gap-3">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($setting->site_logo) }}" alt="Current site logo" class="h-12 w-auto rounded border" style="border-color: var(--color-border); background: #fff;">
                            <span class="text-xs" style="color: var(--color-text-muted);">{{ $setting->site_logo }}</span>
                        </div>
                    @else
                        <div class="mt-2 text-xs" style="color: var(--color-text-muted);">No logo uploaded yet.</div>
                    @endif
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
                <div>
                    <label class="field-label">Landline 1</label>
                    <input type="text" name="landline_1" value="{{ old('landline_1', $setting->landline_1) }}" class="field-input">
                </div>
                <div>
                    <label class="field-label">Landline 2</label>
                    <input type="text" name="landline_2" value="{{ old('landline_2', $setting->landline_2) }}" class="field-input">
                </div>
                <div class="sm:col-span-2">
                    <label class="field-label">Address (Head Office)</label>
                    <textarea name="address" rows="2" class="field-input">{{ old('address', $setting->address) }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <label class="field-label">Address (Branch Office)</label>
                    <textarea name="branch_address" rows="2" class="field-input">{{ old('branch_address', $setting->branch_address) }}</textarea>
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
            <div class="form-section-title">Outgoing email (SMTP)</div>
            <div class="field-hint mb-3">Used to send emails from the site (e.g. enquiry notifications). Leave the password blank to keep the one already saved.</div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="field-label">Mailer</label>
                    <select name="mail_mailer" class="field-input">
                        @foreach (['smtp' => 'SMTP', 'sendmail' => 'Sendmail', 'log' => 'Log (testing only)'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('mail_mailer', $setting->mail_mailer) === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="field-label">Encryption</label>
                    <select name="mail_encryption" class="field-input">
                        <option value="" @selected(old('mail_encryption', $setting->mail_encryption) === null || old('mail_encryption', $setting->mail_encryption) === '')>None</option>
                        <option value="tls" @selected(old('mail_encryption', $setting->mail_encryption) === 'tls')>TLS</option>
                        <option value="ssl" @selected(old('mail_encryption', $setting->mail_encryption) === 'ssl')>SSL</option>
                    </select>
                </div>
                <div>
                    <label class="field-label">SMTP host</label>
                    <input type="text" name="mail_host" value="{{ old('mail_host', $setting->mail_host) }}" placeholder="smtp.example.com" class="field-input">
                </div>
                <div>
                    <label class="field-label">SMTP port</label>
                    <input type="text" name="mail_port" value="{{ old('mail_port', $setting->mail_port) }}" placeholder="587" class="field-input">
                </div>
                <div>
                    <label class="field-label">SMTP username</label>
                    <input type="text" name="mail_username" value="{{ old('mail_username', $setting->mail_username) }}" autocomplete="off" class="field-input">
                </div>
                <div>
                    <label class="field-label">SMTP password</label>
                    <!-- <input type="password" name="mail_password" value="" autocomplete="new-password" placeholder="{{ $setting->mail_password ? '••••••••' : '' }}" class="field-input"> -->
                    <input type="password" name="mail_password" value="" autocomplete="new-password" placeholder="" class="field-input">
                </div>
                <div>
                    <label class="field-label">From address</label>
                    <input type="email" name="mail_from_address" value="{{ old('mail_from_address', $setting->mail_from_address) }}" class="field-input">
                </div>
                <div>
                    <label class="field-label">From name</label>
                    <input type="text" name="mail_from_name" value="{{ old('mail_from_name', $setting->mail_from_name) }}" class="field-input">
                </div>
            </div>
        </div>

        <div class="form-section">
            <button type="submit" class="btn btn-primary">
                Save settings
            </button>
        </div>
    </form>

    <div class="panel p-6 max-w-3xl mt-6">
        <div class="form-section-title">Send a test email</div>
        <div class="field-hint mb-3">Sends a test message using the SMTP settings saved above, so you can confirm they work.</div>
        <form method="POST" action="{{ route('admin.settings.test-email') }}" class="flex flex-col sm:flex-row items-start sm:items-end gap-3">
            @csrf
            <div class="flex-1 w-full">
                <label class="field-label">Send to</label>
                <input type="email" name="test_email" value="{{ old('test_email', $setting->email) }}" required class="field-input">
            </div>
            <div class="flex-1 w-full">
                <label class="field-label">CC (optional)</label>
                <input type="text" name="test_cc" value="{{ old('test_cc') }}" placeholder="cc1@example.com, cc2@example.com" class="field-input">
            </div>
            <button type="submit" class="btn btn-secondary">
                Send test email
            </button>
        </form>
        <div class="field-hint mt-2">Separate multiple CC addresses with commas.</div>
    </div>
@endsection
