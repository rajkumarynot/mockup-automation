
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mockup Ready - Y-Not</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px;">
    <div style="max-width: 600px; background: white; padding: 30px; margin: auto; border-radius: 8px; box-shadow: 0 0 10px #ccc;">
<h2 style="color: #333;">Hello {{ $customerName }},</h2>        
<p>Your mockup for <strong>Order #{{ $orderId }}</strong> is ready.</p>
        <p>You can preview it using the link below:</p>
        <p>
            <a href="{{ $previewUrl }}" style="color: #007bff; text-decoration: none;">
                {{ $previewUrl }}
            </a>
        </p>
        <br>
        <p>Regards,<br>
        The Y-Not Team</p>
    </div>
</body>
</html>
