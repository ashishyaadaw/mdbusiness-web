@extends('layouts.app', [
    'title' => $service['title'] . ' Services',
    'isSearchBar' => false,
    'bodyClass' => 'bg-slate-50',
    'activeMenu' => 'services',
])

@section('content')
    <div class="min-h-screen bg-slate-50">
        <div class="bg-white border-b border-slate-100 px-6 py-12">
            <div class="max-w-4xl mx-auto flex flex-col items-center text-center">
                <div class="w-20 h-20 bg-blue-50 rounded-3xl flex items-center justify-center mb-6 shadow-sm">
                    <i data-lucide="{{ $service['icon'] }}" class="w-10 h-10 text-blue-600"></i>
                </div>
                <h1 class="text-3xl font-extrabold text-slate-900 mb-2">
                    {{ $service['title'] }}
                </h1>
                <p class="text-slate-500 max-w-md">
                    Find the best professional services for {{ strtolower($service['title']) }} tailored to your needs and
                    location.
                </p>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-6 py-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:border-blue-200 transition-colors">
                    <h3 class="font-bold text-slate-800 mb-3 flex items-center gap-2">
                        <i data-lucide="verified" class="w-5 h-5 text-green-500"></i>
                        Verified Providers
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        We only list business partners who have passed our strict verification process to ensure quality and
                        reliability.
                    </p>
                </div>

                <div
                    class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:border-blue-200 transition-colors">
                    <h3 class="font-bold text-slate-800 mb-3 flex items-center gap-2">
                        <i data-lucide="clock" class="w-5 h-5 text-blue-500"></i>
                        24/7 Availability
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Access {{ strtolower($service['title']) }} support anytime, anywhere with our digital-first
                        approach.
                    </p>
                </div>
            </div>

            <div class="mt-10 bg-blue-600 rounded-3xl p-8 text-center text-white shadow-xl shadow-blue-100">
                <h2 class="text-xl font-bold mb-2">Ready to get started?</h2>
                <p class="text-blue-100 text-sm mb-6">Connect with top-rated experts in your area now.</p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button
                        class="bg-white text-blue-600 px-8 py-3 rounded-xl font-bold hover:bg-blue-50 transition-colors flex items-center justify-center gap-2">
                        <i data-lucide="search" class="w-4 h-4"></i>
                        Search Now
                    </button>
                    <button
                        class="bg-blue-500 text-white border border-blue-400 px-8 py-3 rounded-xl font-bold hover:bg-blue-400 transition-colors">
                        Learn More
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Ensure Lucide is initialized --}}
@endsection
