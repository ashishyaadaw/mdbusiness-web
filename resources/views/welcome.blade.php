<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MD Matrimony - Find Your Perfect Match</title>

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
                            serif: ['Playfair Display', 'serif'], /* Premium feel for headings */
                        }
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
    <body class="antialiased text-gray-800 bg-gray-50">

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

        <div class="relative bg-brand-dark h-[600px]">
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=1974&auto=format&fit=crop" alt="Indian Wedding" class="w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-t from-brand-dark via-transparent to-transparent"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col md:flex-row items-center justify-center md:justify-between gap-10">
                
                <div class="text-center md:text-left text-white max-w-xl mt-10 md:mt-0">
                    <h1 class="font-serif text-4xl md:text-6xl font-bold leading-tight mb-4">
                        Find Your <span class="text-brand-gold">Soulmate</span> Today
                    </h1>
                    <p class="text-lg md:text-xl text-gray-200 mb-8 font-light">
                        Trusted by millions of Indians to find their perfect match. Safe, secure, and verified profiles.
                    </p>
                    <div class="flex gap-4 justify-center md:justify-start">
                        <div class="flex items-center gap-2 bg-white/10 px-4 py-2 rounded-lg backdrop-blur-sm border border-white/20">
                            <svg class="w-6 h-6 text-brand-gold" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <span class="font-bold">#1 Trusted App</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-2xl p-6 w-full max-w-md border-t-4 border-brand-gold">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 font-serif">I'm looking for a...</h3>
                    <form action="#" method="GET" class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Gender</label>
                                <select class="w-full border-gray-300 rounded-md shadow-sm focus:border-brand-red focus:ring focus:ring-brand-red focus:ring-opacity-20 py-2 bg-gray-50">
                                    <option>Woman</option>
                                    <option>Man</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Age</label>
                                <div class="flex gap-2 items-center">
                                    <select class="w-full border-gray-300 rounded-md shadow-sm py-2 bg-gray-50"><option>20</option><option>21</option><option selected>24</option></select>
                                    <span class="text-gray-400">to</span>
                                    <select class="w-full border-gray-300 rounded-md shadow-sm py-2 bg-gray-50"><option>28</option><option selected>30</option></select>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Religion</label>
                            <select class="w-full border-gray-300 rounded-md shadow-sm focus:border-brand-red focus:ring focus:ring-brand-red focus:ring-opacity-20 py-2 bg-gray-50">
                                <option>Hindu</option>
                                <option>Muslim</option>
                                <option>Christian</option>
                                <option>Sikh</option>
                                <option>Jain</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Mother Tongue</label>
                            <select class="w-full border-gray-300 rounded-md shadow-sm focus:border-brand-red focus:ring focus:ring-brand-red focus:ring-opacity-20 py-2 bg-gray-50">
                                <option>Hindi</option>
                                <option>Marathi</option>
                                <option>Tamil</option>
                                <option>Telugu</option>
                                <option>Bengali</option>
                            </select>
                        </div>

                        <button type="button" class="w-full bg-brand-red text-white font-bold py-3 rounded-lg hover:bg-brand-dark transition duration-300 shadow-lg mt-2">
                            Let's Begin
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="py-16 mandala-bg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-serif font-bold text-gray-900">Why Choose MD Matrimony?</h2>
                    <div class="w-24 h-1 bg-brand-red mx-auto mt-4 mb-2"></div>
                    <p class="text-gray-600">Genuine profiles, verified by professionals.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition text-center border border-gray-100">
                        <div class="w-16 h-16 bg-brand-light rounded-full flex items-center justify-center mx-auto mb-6 text-brand-red">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">100% Verified Profiles</h3>
                        <p class="text-gray-600">Every profile is manually screened and verified using mobile numbers to ensure a safe matchmaking experience.</p>
                    </div>

                    <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition text-center border border-gray-100">
                        <div class="w-16 h-16 bg-brand-light rounded-full flex items-center justify-center mx-auto mb-6 text-brand-red">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Total Privacy Control</h3>
                        <p class="text-gray-600">You control who sees your photos and contact details. We prioritize your privacy and security above all.</p>
                    </div>

                    <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition text-center border border-gray-100">
                        <div class="w-16 h-16 bg-brand-light rounded-full flex items-center justify-center mx-auto mb-6 text-brand-red">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Intelligent Matchmaking</h3>
                        <p class="text-gray-600">Our proprietary algorithm suggests compatible matches based on community, interests, and lifestyle preferences.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-brand-red py-12">
            <div class="max-w-4xl mx-auto text-center px-4">
                <h2 class="text-3xl font-serif font-bold text-white mb-4">Ready to write your own success story?</h2>
                <p class="text-red-100 mb-8 text-lg">Join thousands of happy couples who found love on MD Matrimony.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-brand-red font-bold rounded-full shadow-lg hover:bg-gray-100 transition">Create Profile for Free</a>
                    <a href="{{ route('login') }}" class="px-8 py-3 bg-transparent border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-brand-red transition">Member Login</a>
                </div>
            </div>
        </div>

        <footer class="bg-gray-900 text-gray-400 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-white text-lg font-bold mb-4">MD Matrimony</h4>
                    <p class="text-sm">The most trusted matrimony service for Indians worldwide. Helping you find your soulmate with ease and security.</p>
                </div>
                <div>
                    <h4 class="text-white text-lg font-bold mb-4">Company</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">About Us</a></li>
                        <li><a href="#" class="hover:text-white">Success Stories</a></li>
                        <li><a href="#" class="hover:text-white">Careers</a></li>
                        <li><a href="#" class="hover:text-white">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-lg font-bold mb-4">Help & Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">24x7 Live Help</a></li>
                        <li><a href="#" class="hover:text-white">Feedback</a></li>
                        <li><a href="#" class="hover:text-white">Safety Tips</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white text-lg font-bold mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white">Terms of Use</a></li>
                    </ul>
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-gray-800 text-center text-sm">
                &copy; {{ date('Y') }} MD Matrimony. All rights reserved.
            </div>
        </footer>

    </body>
</html>