@extends('layouts.app', [
    'title' => 'List Your Business - MD Business Platform',
    'isSearchBar' => false,
    'bodyClass' => 'bg-slate-50',
    'activeMenu' => 'list-business',
])

@section('content')
    <div class="min-h-screen">
        {{-- Hero: Dual Presence --}}
        <div class="bg-gradient-to-br from-blue-700 to-indigo-900 text-white py-20 px-6">
            <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center gap-12">
                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-black leading-tight mb-6">
                        One Listing. <br>
                        <span class="text-blue-300">App + Website</span> Visibility.
                    </h1>
                    <p class="text-lg text-blue-100 mb-8 max-w-lg">
                        Put your business in front of local customers in Gorakhpur. Our platform syncs your data across our
                        Android/iOS App and high-traffic Website instantly.
                    </p>
                    <div class="flex flex-wrap gap-4 justify-center md:justify-start">
                        <a href="#listing-form"
                            class="bg-white text-blue-700 px-8 py-3 rounded-xl font-bold hover:bg-blue-50 transition-all shadow-lg">Start
                            Free Listing</a>
                        <div class="flex items-center gap-2 text-sm font-medium text-blue-200">
                            <i data-lucide="shield-check" class="w-5 h-5"></i> Verified Business Program
                        </div>
                    </div>
                </div>
                <div class="flex-1 hidden md:block">
                    {{-- Placeholder for App & Web Preview Graphics --}}
                    <div class="relative">
                        <div
                            class="bg-white/10 backdrop-blur-md border border-white/20 p-4 rounded-3xl rotate-3 shadow-2xl">
                            <div class="bg-slate-800 rounded-xl h-64 w-full flex items-center justify-center">
                                <i data-lucide="smartphone" class="w-12 h-12 text-blue-400 opacity-50"></i>
                            </div>
                        </div>
                        <div class="absolute -bottom-6 -left-6 bg-white p-2 rounded-xl shadow-xl -rotate-6 hidden lg:block">
                            <div
                                class="bg-slate-100 rounded-lg h-32 w-48 flex items-center justify-center border border-slate-200">
                                <i data-lucide="globe" class="w-8 h-8 text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-6xl mx-auto px-6 -mt-10">
            {{-- Stats / Benefits --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-slate-100 text-center">
                    <div
                        class="w-12 h-12 bg-green-50 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="trending-up" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-bold text-slate-800">24/7 Exposure</h3>
                    <p class="text-sm text-slate-500 mt-2">Your business remains active and searchable even while you sleep.
                    </p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-slate-100 text-center">
                    <div
                        class="w-12 h-12 bg-orange-50 text-orange-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="map-pin" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-bold text-slate-800">Local SEO</h3>
                    <p class="text-sm text-slate-500 mt-2">Rank higher in "near me" searches across Gorakhpur and UP.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-xl border border-slate-100 text-center">
                    <div
                        class="w-12 h-12 bg-purple-50 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="users" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-bold text-slate-800">Direct Leads</h3>
                    <p class="text-sm text-slate-500 mt-2">Customers can call or WhatsApp you directly from the app.</p>
                </div>
            </div>

            {{-- The Process --}}
            <div class="mb-20">
                <h2 class="text-3xl font-bold text-slate-900 text-center mb-12">How to List Your Business</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    @foreach ([['icon' => 'user-plus', 'title' => 'Create Account', 'desc' => 'Sign up with your mobile number.'], ['icon' => 'file-text', 'title' => 'Add Details', 'desc' => 'Upload photos, address, and services.'], ['icon' => 'check-circle', 'title' => 'Verification', 'desc' => 'Our team verifies your business data.'], ['icon' => 'rocket', 'title' => 'Go Live', 'desc' => 'Appear on both App & Website search.']] as $index => $step)
                        <div class="relative text-center">
                            <div
                                class="w-16 h-16 bg-blue-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-4 relative z-10 shadow-lg shadow-blue-200">
                                <i data-lucide="{{ $step['icon'] }}" class="w-8 h-8"></i>
                                <span
                                    class="absolute -top-2 -right-2 bg-slate-900 text-white text-xs w-6 h-6 rounded-full flex items-center justify-center border-2 border-white">{{ $index + 1 }}</span>
                            </div>
                            <h4 class="font-bold text-slate-800 mb-2">{{ $step['title'] }}</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">{{ $step['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Listing Form Section --}}
            <div id="listing-form"
                class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100 flex flex-col lg:flex-row mb-20">
                <div class="lg:w-1/3 bg-slate-900 p-10 text-white">
                    <h3 class="text-2xl font-bold mb-6">Business Registration</h3>
                    <p class="text-slate-400 mb-8">Fill out the basic details and our onboarding executive will contact you
                        within 24 hours to set up your digital storefront.</p>

                    <ul class="space-y-4">
                        <li class="flex items-center gap-3 text-sm text-slate-300">
                            <i data-lucide="check" class="w-5 h-5 text-blue-500"></i> Free for first 3 months
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-300">
                            <i data-lucide="check" class="w-5 h-5 text-blue-500"></i> Dashboard access included
                        </li>
                    </ul>

                    <div class="mt-12 p-4 bg-slate-800 rounded-xl border border-slate-700">
                        <p class="text-xs text-slate-500 uppercase font-bold mb-2">Need Help?</p>
                        <p class="text-lg font-bold">Call: +91 98765 43210</p>
                    </div>
                </div>

                <div class="lg:w-2/3 p-10">
                    <form action="#" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">Business Name</label>
                            <input type="text" placeholder="e.g. Vatrix Technologies"
                                class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">Category</label>
                            <select
                                class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                                <option>Select Category</option>
                                <option>Technology</option>
                                <option>Retail</option>
                                <option>Healthcare</option>
                                <option>Education</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">Owner Name</label>
                            <input type="text" placeholder="Your Name"
                                class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700">WhatsApp Number</label>
                            <input type="tel" placeholder="+91"
                                class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-sm font-bold text-slate-700">Business Address (Gorakhpur)</label>
                            <textarea rows="3" placeholder="Shop No, Street, Landmark..."
                                class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none transition-all"></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <button
                                class="w-full bg-blue-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-blue-700 shadow-lg shadow-blue-100 transition-all flex items-center justify-center gap-3">
                                <i data-lucide="send" class="w-5 h-5"></i>
                                Submit Listing Request
                            </button>
                            <p class="text-center text-xs text-slate-400 mt-4">By submitting, you agree to MD Business
                                Platform's Terms of Service.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
