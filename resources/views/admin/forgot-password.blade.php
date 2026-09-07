<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | MD Business</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-sm bg-white rounded-2xl shadow-xl p-8">
        <h1 class="text-xl font-bold text-gray-900 mb-1">Forgot Password</h1>
        <p class="text-sm text-gray-500 mb-6">We'll text a one-time code to your registered phone.</p>

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.password.otp') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" required autofocus
                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 border px-3 py-2">
            </div>
            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg">
                Send OTP
            </button>
        </form>

        <a href="{{ route('login') }}" class="block text-center text-sm text-gray-500 hover:text-gray-700 mt-5">&larr; Back to sign in</a>
    </div>
</body>
</html>
