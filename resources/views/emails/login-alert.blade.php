<!DOCTYPE html>
<html>
<head>
    <title>New Login Alert</title>
</head>
<body>
    <p>Hi {{ $user->username }},</p>
    
    <p>We detected a new login to your account on {{ config('app.name') }}.</p>
    
    <p>If this was not you, please secure your account immediately by resetting your password.</p>
    
    <p>Thanks,<br>
    The {{ config('app.name') }} Team
    </p>
</body>
</html>