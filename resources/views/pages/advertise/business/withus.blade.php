@extends('layouts.app', [
    'title' => 'Advertise with Us - MD Business Platform',
    'isSearchBar' => false,
    'bodyClass' => 'bg-slate-50',
    'activeMenu' => 'advertise',
])

@section('content')
    <div class="min-h-screen bg-slate-50 pb-20">
        {{-- Hero Header --}}
        <div class="bg-white border-b border-slate-100 px-6 py-16">
            <div class="max-w-4xl mx-auto text-center">
                <span
                    class="bg-blue-100 text-blue-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">Grow
                    Your Brand</span>
                <h1 class="text-4xl font-extrabold text-slate-900 mt-4 mb-4">
                    Advertise on MD Business Platform
                </h1>
                <p class="text-slate-500 text-lg max-w-2xl mx-auto">
                    Reach thousands of local customers in Gorakhpur and beyond. Choose a plan that fits your business goals.
                </p>
            </div>
        </div>

        <div class="max-w-6xl mx-auto px-6 mt-12">

            {{-- Advertising Platforms --}}
            <div class="mb-16">
                <h2 class="text-2xl font-bold text-slate-800 mb-8 text-center">Where Your Business Appears</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach (['Mobile App', 'Web Directory', 'Social Media', 'Email Newsletters'] as $platform)
                        <div class="bg-white p-4 rounded-xl border border-slate-100 flex items-center gap-3 shadow-sm">
                            <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center">
                                <i data-lucide="monitor-smartphone" class="w-5 h-5 text-blue-600"></i>
                            </div>
                            <span class="font-semibold text-slate-700">{{ $platform }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Pricing Plans --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-lg font-bold text-slate-800">Starter</h3>
                    <div class="mt-4 mb-6">
                        <span class="text-3xl font-bold">₹1,999</span><span class="text-slate-500">/month</span>
                    </div>
                    <ul class="space-y-4 mb-8 text-sm text-slate-600">
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-green-500"></i> Business Listing</li>
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-green-500"></i> Basic SEO</li>
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-green-500"></i> 1 Social Post/mo</li>
                    </ul>
                    <button
                        class="w-full py-3 px-4 bg-slate-100 text-slate-800 rounded-xl font-bold hover:bg-slate-200 transition-colors">Choose
                        Starter</button>
                </div>

                <div
                    class="bg-white p-8 rounded-3xl border-2 border-blue-500 shadow-xl relative transform md:-translate-y-4">
                    <div
                        class="absolute -top-4 left-1/2 -translate-x-1/2 bg-blue-500 text-white px-4 py-1 rounded-full text-xs font-bold">
                        MOST POPULAR</div>
                    <h3 class="text-lg font-bold text-slate-800">Growth</h3>
                    <div class="mt-4 mb-6">
                        <span class="text-3xl font-bold">₹4,999</span><span class="text-slate-500">/month</span>
                    </div>
                    <ul class="space-y-4 mb-8 text-sm text-slate-600">
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-blue-500"></i> Top Search Result</li>
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-blue-500"></i> Verified Badge</li>
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-blue-500"></i> 4 Social Posts/mo</li>
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-blue-500"></i> Lead Dashboard</li>
                    </ul>
                    <button
                        class="w-full py-3 px-4 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition-colors">Get
                        Started</button>
                </div>

                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-lg font-bold text-slate-800">Enterprise</h3>
                    <div class="mt-4 mb-6">
                        <span class="text-3xl font-bold">Custom</span>
                    </div>
                    <ul class="space-y-4 mb-8 text-sm text-slate-600">
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-green-500"></i> Home Page Banner</li>
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-green-500"></i> Dedicated Account Manager</li>
                        <li class="flex items-center gap-2"><i data-lucide="check-circle-2"
                                class="w-4 h-4 text-green-500"></i> Video Ad Production</li>
                    </ul>
                    <button
                        class="w-full py-3 px-4 bg-slate-100 text-slate-800 rounded-xl font-bold hover:bg-slate-200 transition-colors">Contact
                        Sales</button>
                </div>
            </div>

            {{-- Executive Contacts --}}
            <div class="bg-slate-900 rounded-3xl p-10 text-white">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
                    <div>
                        <h2 class="text-2xl font-bold mb-4">Speak to our Strategy Experts</h2>
                        <p class="text-slate-400 mb-6">Need a custom marketing plan? Our executives are ready to help you
                            scale your business in Gorakhpur.</p>
                        <div class="space-y-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-800 rounded-full flex items-center justify-center">
                                    <i data-lucide="phone" class="w-5 h-5 text-blue-400"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 uppercase">Call for Support</p>
                                    <p class="font-bold">+91 98765 43210</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-slate-800 rounded-full flex items-center justify-center">
                                    <i data-lucide="mail" class="w-5 h-5 text-blue-400"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 uppercase">Email Us</p>
                                    <p class="font-bold">ads@mdbusiness.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-slate-800 p-6 rounded-2xl border border-slate-700">
                        <h4 class="font-bold mb-4">Request a Callback</h4>
                        <form action="#" class="space-y-3">
                            <input type="text" placeholder="Business Name"
                                class="w-full bg-slate-900 border-slate-700 rounded-lg px-4 py-2 text-sm focus:ring-blue-500">
                            <input type="tel" placeholder="Phone Number"
                                class="w-full bg-slate-900 border-slate-700 rounded-lg px-4 py-2 text-sm focus:ring-blue-500">
                            <button
                                class="w-full bg-blue-600 py-2 rounded-lg font-bold hover:bg-blue-500 transition-colors">Submit
                                Request</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
