<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - MD Matrimony</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { red: '#D32F2F', dark: '#8E0000', gold: '#FFC107', light: '#FFF5F5' }
                    },
                    fontFamily: { sans: ['Instrument Sans', 'sans-serif'], serif: ['Playfair Display', 'serif'] }
                }
            }
        }
    </script>
         <style>
            /* Custom Pattern Background for Indian Vibe */
            .mandala-bg {
                background-color: #ffffff;
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d32f2f' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
        </style>
</head>
<body class=" mandala-bg h-screen flex items-center justify-center">
    <div class="w-full max-w-md  mandala-bg rounded-xl shadow-2xl overflow-hidden border-t-4 border-brand-red">
        <div class="p-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-serif font-bold text-gray-800">Welcome Back</h2>
                <p class="text-gray-500 mt-2">Continue your search for happiness.</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mobile Number / Email ID</label>
                    <input type="text" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-red focus:border-brand-red outline-none transition" placeholder="Enter your ID">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-red focus:border-brand-red outline-none transition" placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded text-brand-red focus:ring-brand-red border-gray-300">
                        <span class="ml-2 text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-brand-red hover:underline font-medium">Forgot Password?</a>
                </div>

                <button type="submit" class="w-full bg-brand-red text-white font-bold py-3 rounded-lg hover:bg-brand-dark transition shadow-lg">
                    Login securely
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-gray-600">
                New to MD Matrimony? 
                <a href="{{ route('register') }}" class="text-brand-red font-bold hover:underline">Register Free</a>
            </div>
        </div>
    </div>
</body>
</html>