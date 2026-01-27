<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { padding: 20px; border: 1px solid #eee; border-radius: 10px; max-width: 600px; }
        .header { border-bottom: 2px solid #2563eb; padding-bottom: 10px; margin-bottom: 20px; }
        .label { font-weight: bold; color: #2563eb; }
        .footer { margin-top: 30px; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Website Inquiry</h2>
        </div>
        
        <p><span class="label">From:</span> {{ $data['name'] }} ({{ $data['email'] }})</p>
        <p><span class="label">Service Requested:</span> {{ $data['service'] }}</p>
        
        <div style="background: #f9f9f9; padding: 15px; border-radius: 5px;">
            <p><span class="label">Message:</span></p>
            <p>{{ $data['message'] }}</p>
        </div>

        <div class="footer">
            Sent via Websamsya Contact Form.
        </div>
    </div>
</body>
</html>