@extends('layouts.app')

@section('content')
    <x-slot:title>Custom Web Development | mdbusiness</x-slot>

    <section class="relative bg-[#145589] py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#145589] via-[#145589] to-[#7f03d3] opacity-90"></div>
        <div class="container mx-auto px-6 relative z-10">
            <nav class="flex mb-8 text-xs font-bold uppercase tracking-[0.2em] text-blue-200" aria-label="Breadcrumb">
                <a href="{{ route('services') }}" class="hover:text-white transition-colors">Services</a>
                <span class="mx-3 opacity-50">/</span>
                <span class="text-[#fd7319]">Custom Web Development</span>
            </nav>

            <h1 class="text-5xl md:text-7xl font-black text-white mb-8 tracking-tighter leading-tight">
                Scalable <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#fd7319] to-orange-300">Digital
                    Engines</span> <br>For Modern Growth.
            </h1>
            <p class="text-xl text-blue-100 max-w-2xl leading-relaxed font-medium">
                We don't just build websites; we engineer high-performance digital ecosystems using Laravel, Vue, and Cloud
                architectures that solve your business "Samsyas."
            </p>
        </div>
    </section>

    <section class="py-24 bg-white relative">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                <div class="space-y-10">
                    <div>
                        <span class="text-[#7f03d3] font-black uppercase tracking-widest text-xs mb-4 block">Bespoke
                            Engineering</span>
                        <h2 class="text-4xl md:text-5xl font-black text-[#145589] leading-tight">
                            Your Business is Unique. <br><span class="text-[#fd7319]">Your Code Should Be Too.</span>
                        </h2>
                    </div>

                    <div class="space-y-8">
                        <div class="flex gap-6 group">
                            <div
                                class="flex-shrink-0 w-14 h-14 bg-[#145589]/5 rounded-2xl flex items-center justify-center text-[#145589] group-hover:bg-[#145589] group-hover:text-white transition-all duration-300">
                                <ion-icon name="construct-outline" class="text-2xl"></ion-icon>
                            </div>
                            <div>
                                <h4 class="font-black text-xl text-[#145589] mb-2">Custom ERP & CRM</h4>
                                <p class="text-gray-600 leading-relaxed">Tailor-made management systems designed to automate
                                    your specific business workflows and eliminate technical debt.</p>
                            </div>
                        </div>

                        <div class="flex gap-6 group">
                            <div
                                class="flex-shrink-0 w-14 h-14 bg-[#7f03d3]/5 rounded-2xl flex items-center justify-center text-[#7f03d3] group-hover:bg-[#7f03d3] group-hover:text-white transition-all duration-300">
                                <ion-icon name="cart-outline" class="text-2xl"></ion-icon>
                            </div>
                            <div>
                                <h4 class="font-black text-xl text-[#145589] mb-2">E-commerce Powerhouses</h4>
                                <p class="text-gray-600 leading-relaxed">Bespoke shopping experiences with complex inventory
                                    logic and custom checkout flows that exceed standard Shopify limitations.</p>
                            </div>
                        </div>

                        <div class="flex gap-6 group">
                            <div
                                class="flex-shrink-0 w-14 h-14 bg-[#fd7319]/5 rounded-2xl flex items-center justify-center text-[#fd7319] group-hover:bg-[#fd7319] group-hover:text-white transition-all duration-300">
                                <ion-icon name="layers-outline" class="text-2xl"></ion-icon>
                            </div>
                            <div>
                                <h4 class="font-black text-xl text-[#145589] mb-2">Enterprise SaaS Platforms</h4>
                                <p class="text-gray-600 leading-relaxed">Multi-tenant applications engineered to scale from
                                    the 10th to the 1-millionth user seamlessly on cloud infrastructure.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute -z-10 -top-10 -right-10 w-72 h-72 bg-[#7f03d3]/10 rounded-full blur-3xl"></div>
                    <div
                        class="bg-gray-50 p-10 rounded-[2.5rem] border border-gray-100 shadow-[0_20px_50px_rgba(20,85,137,0.08)]">
                        <h3 class="text-2xl font-black text-[#145589] mb-8 flex items-center gap-3">
                            Our Modern Stack <ion-icon name="code-slash" class="text-[#fd7319]"></ion-icon>
                        </h3>

                        <div class="flex flex-wrap gap-3">
                            @php
                                $tags = [
                                    'Laravel 11',
                                    'Tailwind CSS',
                                    'PostgreSQL',
                                    'Vue.js 3',
                                    'Node.js',
                                    'AWS Cloud',
                                    'Redis',
                                    'Docker',
                                ];
                            @endphp
                            @foreach ($tags as $tag)
                                <span
                                    class="bg-white px-5 py-2.5 rounded-xl shadow-sm text-sm font-bold text-[#145589] border border-gray-100 hover:border-[#7f03d3] hover:text-[#7f03d3] transition-all cursor-default">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>



                        <div class="mt-12 p-6 bg-[#145589] rounded-2xl text-white">
                            <div class="flex items-center gap-4 mb-4">
                                <img src="https://laravel.com/img/logomark.min.svg" class="w-8" alt="Laravel">
                                <span class="font-black uppercase tracking-widest text-xs">Official Laravel Partners</span>
                            </div>
                            <p class="text-sm text-blue-100 leading-relaxed">
                                We utilize the TALL stack and modular architectures to ensure your web engine is secure,
                                lightning-fast, and easy to maintain.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="lifecycle" class="py-24 bg-gray-50 border-y border-gray-100 overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl md:text-5xl font-black text-[#145589] mb-4">The mdbusiness Lifecycle</h2>
                <p class="text-gray-500 font-medium uppercase tracking-[0.2em] text-xs">From Samsya to Solution</p>
                <div class="h-1.5 w-24 bg-gradient-to-r from-[#fd7319] to-[#7f03d3] mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="mb-20">

            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 relative">

                <div
                    class="group p-8 bg-white rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-transparent hover:border-[#145589]/10">
                    <div
                        class="text-[#145589] opacity-20 font-black text-5xl mb-4 group-hover:opacity-100 transition-opacity">
                        01</div>
                    <h3 class="text-lg font-black text-[#145589] mb-3">Discovery</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">We audit your current tech "Samsyas" and define the MVP
                        roadmap.</p>
                    <div class="mt-4 flex gap-1">
                        <span class="w-2 h-1 bg-[#145589] rounded-full"></span>
                        <span class="w-8 h-1 bg-[#145589]/20 rounded-full"></span>
                    </div>
                </div>

                <div
                    class="group p-8 bg-white rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-transparent hover:border-[#7f03d3]/10 md:mt-12">
                    <div
                        class="text-[#7f03d3] opacity-20 font-black text-5xl mb-4 group-hover:opacity-100 transition-opacity">
                        02</div>
                    <h3 class="text-lg font-black text-[#145589] mb-3">Blueprinting</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">System architecture design and database schema modeling
                        for scale.</p>
                    <div class="mt-4 flex gap-1">
                        <span class="w-2 h-1 bg-[#7f03d3] rounded-full"></span>
                        <span class="w-8 h-1 bg-[#7f03d3]/20 rounded-full"></span>
                    </div>
                </div>

                <div
                    class="group p-8 bg-white rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-transparent hover:border-[#fd7319]/10">
                    <div
                        class="text-[#fd7319] opacity-20 font-black text-5xl mb-4 group-hover:opacity-100 transition-opacity">
                        03</div>
                    <h3 class="text-lg font-black text-[#145589] mb-3">Engineering</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Agile development sprints with weekly demos and
                        clean-code reviews.</p>
                    <div class="mt-4 flex gap-1">
                        <span class="w-2 h-1 bg-[#fd7319] rounded-full"></span>
                        <span class="w-8 h-1 bg-[#fd7319]/20 rounded-full"></span>
                    </div>
                </div>

                <div
                    class="group p-8 bg-white rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-transparent hover:border-[#145589]/10 md:mt-12">
                    <div
                        class="text-[#145589] opacity-20 font-black text-5xl mb-4 group-hover:opacity-100 transition-opacity">
                        04</div>
                    <h3 class="text-lg font-black text-[#145589] mb-3">Hardening</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Automated testing and manual QA to ensure
                        zero-vulnerability logic.</p>
                    <div class="mt-4 flex gap-1">
                        <span class="w-2 h-1 bg-[#145589] rounded-full"></span>
                        <span class="w-8 h-1 bg-[#145589]/20 rounded-full"></span>
                    </div>
                </div>

                <div
                    class="group p-8 bg-[#145589] rounded-[2rem] shadow-xl text-white transition-all duration-500 transform hover:scale-105">
                    <div class="text-white opacity-20 font-black text-5xl mb-4">05</div>
                    <h3 class="text-lg font-black mb-3">Deployment</h3>
                    <p class="text-sm text-blue-100 leading-relaxed">CI/CD pipeline execution and cloud infrastructure
                        scaling.</p>
                    <ion-icon name="rocket" class="mt-4 text-[#fd7319] text-2xl"></ion-icon>
                </div>

            </div>

            <div class="mt-20 flex flex-col md:flex-row items-center justify-center gap-8 opacity-60">
                <div class="flex items-center gap-2">
                    <ion-icon name="sync-outline" class="text-xl"></ion-icon>
                    <span class="text-xs font-bold uppercase tracking-widest">Continuous Integration</span>
                </div>
                <div class="flex items-center gap-2">
                    <ion-icon name="shield-outline" class="text-xl"></ion-icon>
                    <span class="text-xs font-bold uppercase tracking-widest">Security Audited</span>
                </div>
                <div class="flex items-center gap-2">
                    <ion-icon name="pulse-outline" class="text-xl"></ion-icon>
                    <span class="text-xs font-bold uppercase tracking-widest">Post-Launch Monitoring</span>
                </div>
            </div>
        </div>
    </section>

    <x-forms.inquiry-section />
@endsection
