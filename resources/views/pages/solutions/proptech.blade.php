@extends('layouts.app')

@section('content')
    <x-slot:title>PropTech & Real Estate Solutions | mdbusiness</x-slot>

    <main class="bg-white text-gray-900">
        <section class="relative bg-[#145589] py-24 md:py-32 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-[#145589] via-[#145589] to-[#7f03d3] opacity-95"></div>
            <div class="container mx-auto px-6 relative z-10 text-center md:text-left">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <span
                            class="inline-block px-4 py-1 rounded-full bg-white/10 border border-white/20 text-white text-xs font-bold uppercase tracking-[0.3em] mb-6">
                            Real Estate Digitization
                        </span>
                        <h1 class="text-5xl lg:text-7xl font-black text-white leading-tight tracking-tighter">
                            Smart Tech for <br><span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-[#fd7319] to-orange-300">Modern
                                Property.</span>
                        </h1>
                        <p class="mt-8 text-blue-100 text-lg leading-relaxed max-w-xl font-medium">
                            At mdbusiness, we engineer custom digital ecosystems for real estate developers and property
                            managers to solve complex operational "Samsyas."
                        </p>
                        <div class="mt-10 flex flex-wrap gap-4 justify-center md:justify-start">
                            <a href="{{ route('contact') }}"
                                class="px-8 py-4 bg-[#fd7319] text-white rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-[#e66716] transition shadow-xl shadow-orange-200">
                                Get a Free Audit
                            </a>
                            <a href="#solutions"
                                class="px-8 py-4 bg-transparent text-white border-2 border-white/30 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-white hover:text-[#145589] transition">
                                Explore Solutions
                            </a>
                        </div>
                    </div>

                    <div class="relative hidden lg:block">
                        <div
                            class="absolute -bottom-6 -left-6 bg-white p-8 shadow-2xl rounded-[2rem] border border-gray-100 z-20 transform hover:-translate-y-2 transition-transform">
                            <div class="flex items-center gap-4">
                                <div class="p-4 bg-green-50 rounded-2xl text-green-600">
                                    <ion-icon name="trending-up" class="text-3xl"></ion-icon>
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Efficiency
                                        Boost</p>
                                    <p class="text-3xl font-black text-[#145589]">+40%</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-white/10 backdrop-blur-md border border-white/20 h-[450px] rounded-[3rem] overflow-hidden">

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="solutions" class="py-24">
            <div class="container mx-auto px-6">
                <div class="text-center max-w-3xl mx-auto mb-20">
                    <h2 class="text-4xl md:text-5xl font-black text-[#145589] tracking-tighter">Comprehensive PropTech
                        Services</h2>
                    <p class="text-gray-500 mt-4 font-medium uppercase tracking-[0.2em] text-xs">End-to-end development for
                        the property lifecycle</p>
                    <div class="h-1.5 w-24 bg-[#fd7319] mx-auto mt-6 rounded-full"></div>
                </div>

                <div class="grid md:grid-cols-3 gap-10">
                    <div
                        class="group p-10 bg-white rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500">
                        <div
                            class="w-16 h-16 mb-8 rounded-2xl bg-[#145589]/5 flex items-center justify-center text-[#145589] group-hover:bg-[#145589] group-hover:text-white transition-colors duration-300">
                            <ion-icon name="business-outline" class="text-3xl"></ion-icon>
                        </div>
                        <h3 class="text-2xl font-black text-[#145589] mb-4">PMS Development</h3>
                        <p class="text-gray-600 leading-relaxed">Centralized platforms for automated rent collection,
                            AI-based maintenance tracking, and smart tenant portals.</p>
                    </div>

                    <div
                        class="group p-10 bg-white rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 md:mt-12">
                        <div
                            class="w-16 h-16 mb-8 rounded-2xl bg-[#7f03d3]/5 flex items-center justify-center text-[#7f03d3] group-hover:bg-[#7f03d3] group-hover:text-white transition-colors duration-300">
                            <ion-icon name="cube-outline" class="text-3xl"></ion-icon>
                        </div>
                        <h3 class="text-2xl font-black text-[#145589] mb-4">Immersive Tours</h3>
                        <p class="text-gray-600 leading-relaxed">Integration of 3D Matterport tours and AR visualization to
                            let global buyers experience properties with zero travel.</p>
                    </div>

                    <div
                        class="group p-10 bg-white rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500">
                        <div
                            class="w-16 h-16 mb-8 rounded-2xl bg-[#fd7319]/5 flex items-center justify-center text-[#fd7319] group-hover:bg-[#fd7319] group-hover:text-white transition-colors duration-300">
                            <ion-icon name="people-circle-outline" class="text-3xl"></ion-icon>
                        </div>
                        <h3 class="text-2xl font-black text-[#145589] mb-4">Custom Real Estate CRM</h3>
                        <p class="text-gray-600 leading-relaxed">Dedicated sales funnels with automated lead scoring,
                            WhatsApp integration, and real-time inventory management.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 bg-[#0a1931] text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-[#7f03d3]/10 rounded-full blur-3xl"></div>
            <div class="container mx-auto px-6">
                <div class="grid lg:grid-cols-2 gap-20 items-center">
                    <div>
                        <h2 class="text-4xl font-black mb-10 tracking-tighter">Seamless <span class="text-[#fd7319]">Data
                                Connectivity</span></h2>
                        <ul class="space-y-6">
                            <li class="flex items-center gap-4 group">
                                <div
                                    class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 group-hover:bg-blue-400 group-hover:text-white transition-all">
                                    <ion-icon name="checkmark-circle" class="text-2xl"></ion-icon>
                                </div>
                                <span class="text-lg font-medium text-blue-100">Global Payment Gateways (Stripe,
                                    Razorpay)</span>
                            </li>
                            <li class="flex items-center gap-4 group">
                                <div
                                    class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 group-hover:bg-blue-400 group-hover:text-white transition-all">
                                    <ion-icon name="checkmark-circle" class="text-2xl"></ion-icon>
                                </div>
                                <span class="text-lg font-medium text-blue-100">E-Signature Workflows
                                    (DocuSign/HelloSign)</span>
                            </li>
                            <li class="flex items-center gap-4 group">
                                <div
                                    class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 group-hover:bg-blue-400 group-hover:text-white transition-all">
                                    <ion-icon name="checkmark-circle" class="text-2xl"></ion-icon>
                                </div>
                                <span class="text-lg font-medium text-blue-100">Advanced GIS & Google Maps API
                                    Mapping</span>
                            </li>
                        </ul>
                    </div>

                    <div class="relative">
                        <div class="bg-white/5 backdrop-blur-xl p-12 rounded-[3rem] border border-white/10 shadow-2xl">
                            <ion-icon name="quote" class="text-[#fd7319] text-5xl mb-6 opacity-40"></ion-icon>
                            <p class="text-xl italic text-blue-50 leading-relaxed font-light">
                                "mdbusiness's platform reduced our lead response time by 60% and unified our multi-city
                                operations into a single, high-performance dashboard."
                            </p>
                            <div class="mt-10 flex items-center gap-5">
                                <div class="w-14 h-14 bg-gradient-to-r from-[#fd7319] to-[#7f03d3] rounded-full p-0.5">
                                    <div
                                        class="w-full h-full bg-[#0a1931] rounded-full flex items-center justify-center uppercase font-bold text-xs">
                                        DO</div>
                                </div>
                                <div>
                                    <p class="text-lg font-black">Director of Operations</p>
                                    <p class="text-sm text-[#fd7319] font-bold uppercase tracking-widest">Global Real Estate
                                        Group</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <x-forms.inquiry-section />
    </main>
@endsection
