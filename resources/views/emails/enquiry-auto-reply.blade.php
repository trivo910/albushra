<!DOCTYPE html>
<html>
<body style="font-family: sans-serif; color: #1f2933; line-height: 1.6;">
    <p>Hi {{ $enquiry->name }},</p>

    <p>Thank you for reaching out to {{ $setting->site_name ?: config('app.name') }}. We've received your message and one of our team members will get back to you shortly.</p>

    @if ($enquiry->message)
        <p style="color: #6b7280; margin-bottom: 4px;">Your message:</p>
        <p style="white-space: pre-line; border-left: 3px solid #e5e7eb; padding-left: 12px;">{{ $enquiry->message }}</p>
    @endif

    <p>
        In the meantime, feel free to reach us at
        @if ($setting->phone)
            <strong>{{ $setting->phone }}</strong>
        @endif
        @if ($setting->email)
            or <strong>{{ $setting->email }}</strong>
        @endif
        .
    </p>

    <p>Regards,<br>{{ $setting->site_name ?: config('app.name') }}</p>
</body>
</html>
