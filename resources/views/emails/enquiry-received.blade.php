<!DOCTYPE html>
<html>
<body style="font-family: sans-serif; color: #1f2933; line-height: 1.6;">
    <h2 style="margin-bottom: 4px;">
        {{ $enquiry->type === 'booking' ? 'New package enquiry' : 'New contact form submission' }}
    </h2>

    @if ($enquiry->type === 'booking' && $enquiry->package)
        <p style="margin-top: 0;">Package: <strong>{{ $enquiry->package->title }}</strong></p>
    @endif

    <table cellpadding="6" cellspacing="0" style="border-collapse: collapse;">
        <tr>
            <td style="color: #6b7280;">Name</td>
            <td><strong>{{ $enquiry->name }}</strong></td>
        </tr>
        <tr>
            <td style="color: #6b7280;">Email</td>
            <td>{{ $enquiry->email }}</td>
        </tr>
        @if ($enquiry->phone)
            <tr>
                <td style="color: #6b7280;">Phone</td>
                <td>{{ $enquiry->phone }}</td>
            </tr>
        @endif
    </table>

    @if ($enquiry->message)
        <p style="margin-top: 16px; margin-bottom: 4px; color: #6b7280;">Message</p>
        <p style="white-space: pre-line;">{{ $enquiry->message }}</p>
    @endif

    <p style="color: #6b7280; font-size: 12px; margin-top: 24px;">Received {{ $enquiry->created_at->format('d M Y, H:i') }}</p>
</body>
</html>
