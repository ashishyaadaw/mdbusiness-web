@extends('layouts.app')

@section('content')
    <x-slot:title>Custom AI & Machine Learning Solutions | mdbusiness</x-slot>

    <main class="bg-[#040712] text-white overflow-hidden">
        <section class="relative py-24 lg:py-40 overflow-hidden">
            <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-[#145589]/20 rounded-full blur-[120px] animate-pulse">
            </div>
            <div
                class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-[#7f03d3]/10 rounded-full blur-[120px] animate-pulse delay-700">
            </div>

            <div class="container mx-auto px-6 relative z-10 text-center">
                <span
                    class="inline-block py-2 px-6 rounded-full bg-white/5 border border-white/10 text-[#fd7319] text-xs font-black uppercase tracking-[0.4em] mb-8 animate-fade-in">
                    The Future of Intelligence
                </span>

                <h1 class="text-6xl lg:text-8xl font-black tracking-tighter mb-8 leading-none">
                    Solve Complexities with <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#fd7319] via-white to-[#7f03d3]">
                        Custom AI Engines.
                    </span>
                </h1>

                <p class="max-w-3xl mx-auto text-blue-100/70 text-lg md:text-xl mb-12 font-medium leading-relaxed">
                    We bridge the gap between abstract algorithms and real-world business growth. From private LLMs to
                    predictive logistics, we build the "brain" of your next-gen digital ecosystem.
                </p>

                <div class="flex flex-col md:flex-row justify-center gap-6">
                    <a href="{{ route('contact') }}"
                        class="px-10 py-5 bg-[#fd7319] hover:bg-[#e66716] rounded-2xl font-black uppercase tracking-widest text-xs transition-all shadow-xl shadow-orange-500/20">
                        Consult Our AI Architects
                    </a>
                    <a href="#features"
                        class="px-10 py-5 bg-white/5 hover:bg-white/10 rounded-2xl font-black uppercase tracking-widest text-xs border border-white/10 transition-all backdrop-blur-md">
                        Explore Capabilities
                    </a>
                </div>
            </div>
        </section>

        <section id="features" class="py-24 relative">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div
                        class="p-10 rounded-[2.5rem] bg-white/[0.03] border border-white/10 backdrop-blur-xl hover:border-[#fd7319]/50 transition-all group relative overflow-hidden">
                        <div
                            class="absolute -right-4 -top-4 w-24 h-24 bg-[#fd7319]/10 rounded-full blur-2xl group-hover:bg-[#fd7319]/20 transition-all">
                        </div>
                        <div
                            class="w-16 h-16 bg-[#fd7319]/20 rounded-2xl flex items-center justify-center mb-8 group-hover:rotate-12 transition-transform">
                            <ion-icon name="chatbox-ellipses-outline" class="text-3xl text-[#fd7319]"></ion-icon>
                        </div>
                        <h3 class="text-2xl font-black text-white mb-4 tracking-tighter">Generative LLMs</h3>
                        <p class="text-blue-100/60 leading-relaxed">Private GPT models trained on your proprietary data for
                            ultra-secure customer support and internal knowledge management.</p>
                    </div>

                    <div
                        class="p-10 rounded-[2.5rem] bg-white/[0.03] border border-white/10 backdrop-blur-xl hover:border-white/50 transition-all group relative overflow-hidden">
                        <div
                            class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mb-8 group-hover:rotate-12 transition-transform">
                            <ion-icon name="scan-outline" class="text-3xl text-white"></ion-icon>
                        </div>
                        <h3 class="text-2xl font-black text-white mb-4 tracking-tighter">Computer Vision</h3>
                        <p class="text-blue-100/60 leading-relaxed">Automated visual inspection, object recognition, and
                            thermal mapping systems engineered for PropTech and Smart Factories.</p>
                    </div>

                    <div
                        class="p-10 rounded-[2.5rem] bg-white/[0.03] border border-white/10 backdrop-blur-xl hover:border-[#7f03d3]/50 transition-all group relative overflow-hidden">
                        <div
                            class="absolute -right-4 -top-4 w-24 h-24 bg-[#7f03d3]/10 rounded-full blur-2xl group-hover:bg-[#7f03d3]/20 transition-all">
                        </div>
                        <div
                            class="w-16 h-16 bg-[#7f03d3]/20 rounded-2xl flex items-center justify-center mb-8 group-hover:rotate-12 transition-transform">
                            <ion-icon name="analytics-outline" class="text-3xl text-[#7f03d3]"></ion-icon>
                        </div>
                        <h3 class="text-2xl font-black text-white mb-4 tracking-tighter">Predictive Analysis</h3>
                        <p class="text-blue-100/60 leading-relaxed">Forecast demand, optimize pricing, and identify
                            operational risks before they happen with custom regression models.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 bg-white/5 border-y border-white/5">
            <div class="container mx-auto px-6">
                <div class="text-center mb-20">
                    <h2 class="text-4xl md:text-5xl font-black tracking-tighter mb-4">How We Deploy AI</h2>
                    <div class="h-1.5 w-24 bg-gradient-to-r from-[#fd7319] to-[#7f03d3] mx-auto rounded-full"></div>
                </div>

                <div class="flex flex-col lg:flex-row justify-between items-start gap-12 relative">
                    <div class="flex-1 group">
                        <div
                            class="text-[#fd7319] font-black text-6xl mb-6 opacity-20 group-hover:opacity-100 transition-opacity">
                            01</div>
                        <h4 class="text-2xl font-bold mb-4">Data Hardening</h4>
                        <p class="text-blue-100/60 leading-relaxed">Cleaning, structuring, and labeling your historical data
                            to ensure model precision and bias elimination.</p>
                    </div>

                    <ion-icon name="chevron-forward-outline"
                        class="hidden lg:block mt-16 text-white/20 text-3xl"></ion-icon>

                    <div class="flex-1 group">
                        <div
                            class="text-white font-black text-6xl mb-6 opacity-20 group-hover:opacity-100 transition-opacity">
                            02</div>
                        <h4 class="text-2xl font-bold mb-4">Engine Training</h4>
                        <p class="text-blue-100/60 leading-relaxed">Iterative model training and hyperparameter tuning to
                            achieve the exact performance metrics your business requires.</p>
                    </div>

                    <ion-icon name="chevron-forward-outline"
                        class="hidden lg:block mt-16 text-white/20 text-3xl"></ion-icon>

                    <div class="flex-1 group">
                        <div
                            class="text-[#7f03d3] font-black text-6xl mb-6 opacity-20 group-hover:opacity-100 transition-opacity">
                            03</div>
                        <h4 class="text-2xl font-bold mb-4">Neural Integration</h4>
                        <p class="text-blue-100/60 leading-relaxed">Developing high-speed APIs to connect your new AI engine
                            seamlessly with your Flutter or Laravel applications.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <x-forms.inquiry-section />
@endsection
