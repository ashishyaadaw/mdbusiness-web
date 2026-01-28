@extends('layouts.app')

@section('content')
    <x-slot:title>Expert Flutter App Development | mdbusiness</x-slot>

    <section class="relative bg-[#145589] py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#145589] via-[#145589] to-[#7f03d3] opacity-95"></div>
        <div class="container mx-auto px-6 relative z-10 text-center md:text-left">
            <nav class="flex justify-center md:justify-start mb-8 text-xs font-bold uppercase tracking-[0.2em] text-blue-200"
                aria-label="Breadcrumb">
                <a href="{{ route('services') }}" class="hover:text-white transition-colors">Services</a>
                <span class="mx-3 opacity-50">/</span>
                <span class="text-[#fd7319]">Mobile App Development</span>
            </nav>
            <h1 class="text-5xl md:text-8xl font-black text-white mb-8 tracking-tighter leading-tight">
                Crafting <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#fd7319] to-orange-300">Fluid
                    Experiences.</span>
            </h1>
            <p class="text-xl text-blue-100 max-w-2xl leading-relaxed font-medium mx-auto md:mx-0">
                High-performance iOS and Android applications built with Flutter. We turn your mobile "Samsya" into a
                seamless, native-quality reality.
            </p>
        </div>
    </section>

    <section class="py-24 bg-white relative">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                <div class="space-y-12">
                    <div>
                        <span class="text-[#7f03d3] font-black uppercase tracking-widest text-xs mb-4 block">Cross-Platform
                            Excellence</span>
                        <h2 class="text-4xl font-black text-[#145589] leading-tight">Native Performance. <br><span
                                class="text-[#fd7319]">One Single Codebase.</span></h2>
                    </div>

                    <div class="space-y-8">
                        <div class="flex gap-6 group">
                            <div
                                class="flex-shrink-0 w-16 h-16 bg-[#145589]/5 rounded-2xl flex items-center justify-center text-[#145589] group-hover:bg-[#145589] group-hover:text-white transition-all duration-300">
                                <ion-icon name="phone-portrait-outline" class="text-3xl"></ion-icon>
                            </div>
                            <div>
                                <h4 class="font-black text-xl text-[#145589] mb-2">iOS & Android Sprints</h4>
                                <p class="text-gray-600 leading-relaxed text-sm">We build once and deploy everywhere. Our
                                    Flutter architecture ensures 60FPS performance on both platforms simultaneously.</p>
                            </div>
                        </div>

                        <div class="flex gap-6 group">
                            <div
                                class="flex-shrink-0 w-16 h-16 bg-[#7f03d3]/5 rounded-2xl flex items-center justify-center text-[#7f03d3] group-hover:bg-[#7f03d3] group-hover:text-white transition-all duration-300">
                                <ion-icon name="color-palette-outline" class="text-3xl"></ion-icon>
                            </div>
                            <div>
                                <h4 class="font-black text-xl text-[#145589] mb-2">Intuitive UI/UX Design</h4>
                                <p class="text-gray-600 leading-relaxed text-sm">User-centric design focused on
                                    thumb-friendly navigation, dark mode support, and smooth micro-animations.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-10 rounded-[3rem] border border-gray-100 shadow-2xl relative">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#7f03d3]/10 rounded-full blur-3xl"></div>
                    <h3 class="text-2xl font-black text-[#145589] mb-8">Our Mobile Tech Stack</h3>
                    <div class="flex flex-wrap gap-3 mb-8">
                        @foreach (['Flutter 3.x', 'Dart', 'Firebase', 'SQLite', 'REST APIs', 'GraphQL', 'Bloc / Riverpod', 'Codemagic'] as $tag)
                            <span
                                class="bg-white px-5 py-3 rounded-2xl shadow-sm text-sm font-bold text-[#145589] border border-gray-100">{{ $tag }}</span>
                        @endforeach
                    </div>



                    <div class="mt-8 p-6 bg-gradient-to-r from-[#145589] to-[#7f03d3] rounded-3xl text-white">
                        <div class="flex items-center gap-3 mb-2">
                            <ion-icon name="medal-outline" class="text-[#fd7319] text-2xl"></ion-icon>
                            <span class="font-black uppercase tracking-widest text-[10px]">Quality Standard</span>
                        </div>
                        <p class="text-blue-50 text-sm">Every app undergoes rigorous testing on real physical devices to
                            ensure zero-crash reliability before Store submission.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-gray-50 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-black text-[#145589] mb-4">App Investment Tiers</h2>
                <div class="h-1.5 w-24 bg-gradient-to-r from-[#fd7319] to-[#7f03d3] mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div
                    class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-lg transition-all flex flex-col">
                    <h3 class="text-lg font-black text-[#145589] mb-2">Essential App</h3>
                    <p class="text-gray-500 text-xs mb-6 uppercase tracking-wider font-bold">Rapid Web-to-App</p>
                    <div class="text-3xl font-black text-[#145589] mb-6">₹ 25k <span
                            class="text-xs font-normal text-gray-400">/flat</span></div>
                    <ul class="space-y-3 mb-8 text-sm text-gray-600 flex-grow">
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> WebView Architecture</li>
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> Basic Push Notifications</li>
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> Play Store / App Store</li>
                    </ul>
                    <a href="#inquiry"
                        class="block text-center py-3 border-2 border-[#145589] text-[#145589] rounded-xl font-bold uppercase tracking-widest text-[10px] hover:bg-[#145589] hover:text-white transition-all">Choose
                        Essential</a>
                </div>

                <div
                    class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-lg transition-all flex flex-col">
                    <h3 class="text-lg font-black text-[#145589] mb-2">Custom MVP</h3>
                    <p class="text-gray-500 text-xs mb-6 uppercase tracking-wider font-bold">Core Features</p>
                    <div class="text-3xl font-black text-[#145589] mb-6">₹ 85k <span
                            class="text-xs font-normal text-gray-400">/start</span></div>
                    <ul class="space-y-3 mb-8 text-sm text-gray-600 flex-grow">
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> Native Flutter UI</li>
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> Firebase Integration</li>
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> User Profiles & Auth</li>
                    </ul>
                    <a href="#inquiry"
                        class="block text-center py-3 bg-[#145589] text-white rounded-xl font-bold uppercase tracking-widest text-[10px] hover:bg-[#7f03d3] transition-colors">Launch
                        MVP</a>
                </div>

                <div
                    class="bg-white p-8 rounded-[2rem] border-4 border-[#7f03d3] shadow-2xl relative transform lg:scale-105 flex flex-col z-10">
                    <div
                        class="absolute -top-4 left-1/2 -translate-x-1/2 bg-[#7f03d3] text-white px-4 py-1 rounded-full text-[10px] font-black tracking-widest">
                        BEST VALUE</div>
                    <h3 class="text-lg font-black text-[#145589] mb-2 mt-2">Premium SaaS</h3>
                    <p class="text-gray-500 text-xs mb-6 uppercase tracking-wider font-bold">Full Ecosystem</p>
                    <div class="text-3xl font-black text-[#7f03d3] mb-6">₹ 185k <span
                            class="text-xs font-normal text-gray-400">/est</span></div>
                    <ul class="space-y-3 mb-8 text-sm text-gray-600 flex-grow">
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> Multi-Language Support</li>
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> Payment Gateway</li>
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> Offline Mode Sync</li>
                    </ul>
                    <a href="#inquiry"
                        class="block text-center py-3 bg-[#7f03d3] text-white rounded-xl font-bold uppercase tracking-widest text-[10px] shadow-lg shadow-purple-200">Scale
                        App</a>
                </div>

                <div class="bg-[#145589] p-8 rounded-[2rem] shadow-xl text-white flex flex-col">
                    <h3 class="text-lg font-black mb-2">Enterprise</h3>
                    <p class="text-blue-200 text-xs mb-6 uppercase tracking-wider font-bold">Advanced Logic</p>
                    <div class="text-3xl font-black text-white mb-6">₹ 350k <span
                            class="text-xs font-normal text-blue-300">/min</span></div>
                    <ul class="space-y-3 mb-8 text-sm text-blue-100 flex-grow">
                        <li class="flex items-start gap-2"><ion-icon name="infinite-outline"
                                class="text-[#fd7319] mt-0.5"></ion-icon> Custom AI / ML Features</li>
                        <li class="flex items-start gap-2"><ion-icon name="infinite-outline"
                                class="text-[#fd7319] mt-0.5"></ion-icon> Real-time Data Viz</li>
                        <li class="flex items-start gap-2"><ion-icon name="infinite-outline"
                                class="text-[#fd7319] mt-0.5"></ion-icon> High-Level Encryption</li>
                    </ul>
                    <a href="#inquiry"
                        class="block text-center py-3 bg-[#fd7319] text-white rounded-xl font-bold uppercase tracking-widest text-[10px] hover:bg-white hover:text-[#145589] transition-all">Request
                        Quote</a>
                </div>
            </div>
        </div>
    </section>

    <x-forms.inquiry-section />
@endsection
