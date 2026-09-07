<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | MD Business</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-sm bg-white rounded-2xl shadow-xl p-8">
        <h1 class="text-xl font-bold text-gray-900 mb-1">MD Business</h1>
        <p class="text-sm text-gray-500 mb-6">Admin / Staff sign in</p>

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

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" required autofocus
                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 border px-3 py-2">
            </div>
            <div>
                <div class="flex items-center justify-between mb-1">
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <a href="{{ route('admin.password.request') }}" class="text-xs text-indigo-600 hover:underline">Forgot password?</a>
                </div>
                <input type="password" name="password" required
                       class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 border px-3 py-2">
            </div>
            <label class="flex items-center gap-2 text-sm text-gray-600">
                <input type="checkbox" name="remember"> Remember me
            </label>
            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg">
                Sign in
            </button>
        </form>
    </div>
</body>
</html>
