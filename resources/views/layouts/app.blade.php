<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'MD Matrimony - Find Your Perfect Match')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:600,700" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            red: '#D32F2F',    /* Indian Wedding Red */
                            dark: '#8E0000',
                            gold: '#FFC107',   /* Jewelry Gold */
                            light: '#FFF5F5',
                        }
                    },
                    fontFamily: {
                        sans: ['Instrument Sans', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        .mandala-bg {
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d32f2f' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="antialiased text-gray-800 bg-gray-50 mandala-bg">
       <header class="bg-white shadow-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex-shrink-0 flex items-center gap-2">
                        <img src="/logo.png" alt="MD Matrimony" class="h-12"/>
                    </div>

                    @if (Route::has('login'))
                        <div class="flex items-center gap-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-brand-red">Dashboard</a>
                            @else
                                <span class="hidden md:inline text-sm text-gray-500">Already a Member?</span>
                                <a href="{{ route('login') }}" class="px-5 py-2 border border-brand-red text-brand-red rounded-full text-sm font-semibold hover:bg-brand-light transition">Log In</a>
                                
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-5 py-2 bg-brand-red text-white rounded-full text-sm font-semibold hover:bg-brand-dark shadow-lg shadow-red-200 transition">Register Free</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </header>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h4 class="text-white text-lg font-bold mb-4">MD Matrimony</h4>
                <p class="text-sm">The most trusted matrimony service for Indians worldwide. Helping you find your soulmate with ease and security.</p>
            </div>
            <div>
                <h4 class="text-white text-lg font-bold mb-4">Company</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-brand-gold transition-colors">About Us</a></li>
                    <li><a href="#" class="hover:text-brand-gold transition-colors">Success Stories</a></li>
                    <li><a href="#" class="hover:text-brand-gold transition-colors">Careers</a></li>
                    <li><a href="#" class="hover:text-brand-gold transition-colors">Contact Us</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white text-lg font-bold mb-4">Help & Support</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-brand-gold transition-colors">24x7 Live Help</a></li>
                    <li><a href="#" class="hover:text-brand-gold transition-colors">Feedback</a></li>
                    <li><a href="#" class="hover:text-brand-gold transition-colors">Safety Tips</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white text-lg font-bold mb-4">Legal</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-brand-gold transition-colors">Privacy Policy</a></li>
                    <li><a href="{{ route('pages.terms') }}" class="hover:text-brand-gold transition-colors font-bold text-white border-b border-brand-red">Terms of Use</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-gray-800 text-center text-sm">
            &copy; {{ date('Y') }} MD Matrimony. All rights reserved.
        </div>
    </footer>
</body>
</html>