<!DOCTYPE html>
<html>
<body style="font-family: sans-serif; color: #1f2933; line-height: 1.6;">
    <p>This is a test email from <strong>{{ $siteName }}</strong>.</p>
    <p>If you received this, the SMTP settings configured in the admin panel are working correctly.</p>
    <p style="color: #6b7280; font-size: 12px;">Sent {{ now()->format('d M Y, H:i') }}</p>
</body>
</html>
