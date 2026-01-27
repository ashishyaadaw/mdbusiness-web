@extends('layouts.app')

@section('content')
    <x-slot:title>Enterprise Web Development | Websamsya</x-slot>

    <section class="relative bg-[#145589] py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#145589] via-[#145589] to-[#7f03d3] opacity-95"></div>
        <div class="container mx-auto px-6 relative z-10 text-center md:text-left">
            <nav class="flex justify-center md:justify-start mb-8 text-xs font-bold uppercase tracking-[0.2em] text-blue-200"
                aria-label="Breadcrumb">
                <a href="{{ route('services') }}" class="hover:text-white transition-colors">Services</a>
                <span class="mx-3 opacity-50">/</span>
                <span class="text-[#fd7319]">Web Development</span>
            </nav>
            <h1 class="text-5xl md:text-8xl font-black text-white mb-8 tracking-tighter leading-tight">
                Architecting <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-[#fd7319] to-orange-300">Digital
                    Engines.</span>
            </h1>
            <p class="text-xl text-blue-100 max-w-2xl leading-relaxed font-medium mx-auto md:mx-0">
                Custom-built web ecosystems using Laravel and Cloud architectures designed to solve complex business
                "Samsyas" and scale with your vision.
            </p>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-20 items-center">
                <div class="space-y-12">
                    <div>
                        <span class="text-[#7f03d3] font-black uppercase tracking-widest text-xs mb-4 block">Our
                            Expertise</span>
                        <h2 class="text-4xl font-black text-[#145589] leading-tight">Elite Web Engineering <br>For
                            High-Impact Brands.</h2>
                    </div>

                    <div class="grid grid-cols-1 gap-8">
                        <div class="flex gap-6 group">
                            <div
                                class="flex-shrink-0 w-16 h-16 bg-[#145589]/5 rounded-2xl flex items-center justify-center text-[#145589] group-hover:bg-[#145589] group-hover:text-white transition-all duration-300">
                                <ion-icon name="server-outline" class="text-3xl"></ion-icon>
                            </div>
                            <div>
                                <h4 class="font-black text-xl text-[#145589] mb-2">Enterprise ERP/CRM</h4>
                                <p class="text-gray-600 leading-relaxed text-sm">Modular management systems built to
                                    automate complex workflows, inventory management, and multi-tenant operations.</p>
                            </div>
                        </div>

                        <div class="flex gap-6 group">
                            <div
                                class="flex-shrink-0 w-16 h-16 bg-[#7f03d3]/5 rounded-2xl flex items-center justify-center text-[#7f03d3] group-hover:bg-[#7f03d3] group-hover:text-white transition-all duration-300">
                                <ion-icon name="cart-outline" class="text-3xl"></ion-icon>
                            </div>
                            <div>
                                <h4 class="font-black text-xl text-[#145589] mb-2">Scalable E-commerce</h4>
                                <p class="text-gray-600 leading-relaxed text-sm">Bespoke shopping experiences that bypass
                                    Shopify limitations, offering custom payment gateways and complex product logic.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-10 rounded-[3rem] border border-gray-100 shadow-2xl relative">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#fd7319]/10 rounded-full blur-3xl"></div>
                    <h3 class="text-2xl font-black text-[#145589] mb-8">The Websamsya Stack</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach (['Laravel 11', 'Vue.js', 'PostgreSQL', 'AWS', 'Redis', 'Docker', 'Inertia.js'] as $tag)
                            <span
                                class="bg-white px-5 py-3 rounded-2xl shadow-sm text-sm font-bold text-[#145589] border border-gray-100">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <div class="mt-10 p-6 bg-[#145589] rounded-3xl text-white">
                        <p class="text-xs font-black uppercase tracking-widest text-orange-400 mb-2">Performance Promise</p>
                        <h4 class="font-bold text-lg mb-2 text-white">Lighthouse Score: 90+</h4>
                        <p class="text-blue-100 text-sm">We guarantee sub-second load times and zero-vulnerability
                            deployment as a standard for every project.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-gray-50 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-black text-[#145589] mb-4">Investment Tiers</h2>
                <p class="text-gray-500 font-medium tracking-wide uppercase text-xs">Transparent pricing for every stage of
                    your digital journey.</p>
                <div class="h-1 w-20 bg-[#fd7319] mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div
                    class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-lg transition-all flex flex-col">
                    <h3 class="text-lg font-black text-[#145589] mb-2">Essential</h3>
                    <p class="text-gray-500 text-xs mb-6 uppercase tracking-wider font-bold">Rapid Deployment</p>
                    <div class="text-3xl font-black text-[#145589] mb-6">₹ 15k <span
                            class="text-xs font-normal text-gray-400">/flat</span></div>

                    <ul class="space-y-3 mb-8 text-sm text-gray-600 flex-grow">
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> High-Quality Template UI</li>
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> 5 Professional Pages</li>
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> Mobile Responsive</li>
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> Basic SEO Setup</li>
                    </ul>
                    <a href="#inquiry"
                        class="block text-center py-3 border-2 border-[#145589] text-[#145589] rounded-xl font-bold uppercase tracking-widest text-[10px] hover:bg-[#145589] hover:text-white transition-all">Choose
                        Essential</a>
                </div>

                <div
                    class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-lg transition-all flex flex-col">
                    <h3 class="text-lg font-black text-[#145589] mb-2">MVP / Startup</h3>
                    <p class="text-gray-500 text-xs mb-6 uppercase tracking-wider font-bold">Custom Logic</p>
                    <div class="text-3xl font-black text-[#145589] mb-6">₹ 55k <span
                            class="text-xs font-normal text-gray-400">/start</span></div>

                    <ul class="space-y-3 mb-8 text-sm text-gray-600 flex-grow">
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> Bespoke UX/UI Design</li>
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> User Authentication</li>
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> Dashboard Integration</li>
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> 30-Day Tech Support</li>
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
                    <h3 class="text-lg font-black text-[#145589] mb-2 mt-2">Growth / SaaS</h3>
                    <p class="text-gray-500 text-xs mb-6 uppercase tracking-wider font-bold">Market Ready</p>
                    <div class="text-3xl font-black text-[#7f03d3] mb-6">₹ 145k <span
                            class="text-xs font-normal text-gray-400">/est</span></div>

                    <ul class="space-y-3 mb-8 text-sm text-gray-600 flex-grow">
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> Full-Stack Engineering</li>
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> Payment Gateway</li>
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> Advanced API Ecosystem</li>
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-green-500 mt-0.5"></ion-icon> 90-Day Priority Care</li>
                    </ul>
                    <a href="#inquiry"
                        class="block text-center py-3 bg-[#7f03d3] text-white rounded-xl font-bold uppercase tracking-widest text-[10px] shadow-lg shadow-purple-200">Scale
                        Business</a>
                </div>

                <div class="bg-[#145589] p-8 rounded-[2rem] shadow-xl text-white flex flex-col">
                    <h3 class="text-lg font-black mb-2">Enterprise</h3>
                    <p class="text-blue-200 text-xs mb-6 uppercase tracking-wider font-bold">Complex Systems</p>
                    <div class="text-3xl font-black text-white mb-6">₹ 299k <span
                            class="text-xs font-normal text-blue-300">/min</span></div>

                    <ul class="space-y-3 mb-8 text-sm text-blue-100 flex-grow">
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-[#fd7319] mt-0.5"></ion-icon> High-Traffic Architecture</li>
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-[#fd7319] mt-0.5"></ion-icon> AI Workflow Automation</li>
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-[#fd7319] mt-0.5"></ion-icon> Dedicated Support Lead</li>
                        <li class="flex items-start gap-2"><ion-icon name="checkmark-circle"
                                class="text-[#fd7319] mt-0.5"></ion-icon> Multi-region Hosting</li>
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
