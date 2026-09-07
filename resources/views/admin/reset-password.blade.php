<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | MD Business</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-sm bg-white rounded-2xl shadow-xl p-8">
        <h1 class="text-xl font-bold text-gray-900 mb-1">Enter OTP</h1>
        <p class="text-sm text-gray-500 mb-6">Code sent to {{ $phone }}. Valid for 5 minutes.</p>

        @if (session('status'))
            <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3 text-sm">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.password.reset') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">OTP</label>
                <input type="text" name="otp" required autofocus inputmode="numeric"
                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 border px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                <input type="password" name="password" required minlength="8"
                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 border px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                <input type="password" name="password_confirmation" required minlength="8"
                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 border px-3 py-2">
            </div>
            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg">
                Reset Password
            </button>
        </form>

        <form method="POST" action="{{ route('admin.password.otp') }}" class="mt-3">
            @csrf
            <input type="hidden" name="phone" value="{{ $phone }}">
            <button type="submit" class="w-full text-center text-sm text-gray-500 hover:text-gray-700">
                Didn't get a code? Resend OTP
            </button>
        </form>
    </div>
</body>
</html>
