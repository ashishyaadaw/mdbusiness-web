@extends('layouts.app')

@section('content')
    <x-slot:title>Products | Websamsya - Innovative Software Solutions</x-slot>

    <section class="bg-gradient-to-r from-blue-900 to-slate-900 py-20 text-white">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-6">Our Digital <span class="text-blue-400">Products</span></h1>
            <p class="text-gray-300 text-lg max-w-2xl mx-auto">
                Explore our suite of ready-made software solutions designed to solve real-world problems and accelerate business growth.
            </p>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="space-y-24">
                
                @php
                    $products = [
                        [
                            'name' => 'MD Matrimony',
                            'tagline' => 'Community-Driven Matchmaking',
                            'description' => 'A comprehensive matrimonial platform built with Flutter and Laravel. Features include premium profile matching, secure chat, and advanced search filters.',
                            'tech' => ['Flutter', 'Laravel API', 'JWT Auth', 'MySQL'],
                            'image' => '/assets/images/md-matrimony-mockup.png',
                            'link' => '#',
                            'is_live' => true
                        ],
                        [
                            'name' => 'Websamsya Agency Portal',
                            'tagline' => 'Digital Service Management',
                            'description' => 'A centralized platform for clients to track project progress, request support, and manage advertising campaigns through One Advertisers.',
                            'tech' => ['Tailwind CSS', 'jQuery', 'Laravel', 'Blade'],
                            'image' => '/assets/images/websamsya-portal.png',
                            'link' => '#',
                            'is_live' => false
                        ]
                    ];
                @endphp

                @foreach($products as $index => $product)
                <div class="flex flex-col {{ $index % 2 == 0 ? 'lg:flex-row' : 'lg:flex-row-reverse' }} items-center gap-12">
                    <div class="w-full lg:w-1/2">
                        <div class="relative group">
                            <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                            <div class="relative bg-white rounded-2xl overflow-hidden shadow-2xl">
                                <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-auto transform group-hover:scale-105 transition duration-500">
                            </div>
                        </div>
                    </div>

                    <div class="w-full lg:w-1/2 space-y-6">
                        <div class="flex items-center gap-3">
                            <h2 class="text-3xl font-bold text-gray-900">{{ $product['name'] }}</h2>
                            @if($product['is_live'])
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full uppercase tracking-widest">Live Now</span>
                            @else
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full uppercase tracking-widest">In Development</span>
                            @endif
                        </div>
                        <p class="text-blue-600 font-semibold tracking-wide uppercase text-sm">{{ $product['tagline'] }}</p>
                        <p class="text-gray-600 text-lg leading-relaxed">{{ $product['description'] }}</p>
                        
                        <div class="flex flex-wrap gap-2">
                            @foreach($product['tech'] as $t)
                                <span class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium border border-gray-200">{{ $t }}</span>
                            @endforeach
                        </div>

                        <div class="pt-6">
                            <a href="{{ $product['link'] }}" class="inline-flex items-center justify-center px-8 py-4 bg-slate-900 text-white font-bold rounded-xl hover:bg-blue-700 transition-all shadow-lg hover:shadow-blue-200">
                                View Case Study <i class="fas fa-arrow-right ml-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="py-16 bg-blue-50 border-y border-blue-100">
        <div class="container mx-auto px-6 text-center">
            <h3 class="text-2xl font-bold text-gray-800 mb-8">Our Product Philosophy</h3>
            
            <div class="grid md:grid-cols-3 gap-8 mt-12">
                <div class="p-6">
                    <h4 class="font-bold text-lg mb-2">Scalable Architecture</h4>
                    <p class="text-gray-600 text-sm">Built to grow from 100 to 1,000,000 users without breaking a sweat.</p>
                </div>
                <div class="p-6">
                    <h4 class="font-bold text-lg mb-2">Security First</h4>
                    <p class="text-gray-600 text-sm">Implementing JWT, encryption, and secure APIs as standard practice.</p>
                </div>
                <div class="p-6">
                    <h4 class="font-bold text-lg mb-2">User Centric</h4>
                    <p class="text-gray-600 text-sm">Optimized interfaces that make the user journey seamless and fast.</p>
                </div>
            </div>
        </div>
    </section>

    <x-forms.inquiry-section />
@endsection