@extends('layouts.app')

@section('content')
    <x-slot:title>About Our Vision | mdbusiness</x-slot>

    <section class="relative py-24 md:py-32 overflow-hidden bg-[#145589]">
        <div class="absolute inset-0 bg-gradient-to-br from-[#145589] via-[#145589] to-[#7f03d3] opacity-90"></div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <div
                class="inline-block px-4 py-1 rounded-full bg-white/10 border border-white/20 text-white text-xs font-bold uppercase tracking-[0.3em] mb-6 animate-fade-in">
                Est. 2025
            </div>
            <h1 class="text-5xl md:text-7xl font-black text-white mb-8 tracking-tighter">
                Solving Complexities,<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#fd7319] to-orange-300">Building
                    Realities.</span>
            </h1>
            <p class="text-blue-100 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed font-light">
                mdbusiness is more than a development agency. We are a team of architects, dreamers, and engineers dedicated
                to transforming your biggest "Samsya" (problems) into scalable digital legacies.
            </p>
        </div>
    </section>

    <section class="py-24 bg-white relative">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-2 text-[#7f03d3] font-bold uppercase text-sm tracking-widest">
                        <span class="w-10 h-[2px] bg-[#7f03d3]"></span> Our Mission
                    </div>
                    <h2 class="text-4xl font-black text-[#145589] leading-tight">
                        Empowering Growth Through <br><span class="text-[#fd7319]">Elite Engineering.</span>
                    </h2>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        We empower entrepreneurs by providing the high-end technology usually reserved for tech giants. From
                        **Flutter mobile experiences** to **robust Laravel backends**, we ensure your stack is built for the
                        1-millionth user, not just the first.
                    </p>

                    <button id="readMoreBtn"
                        class="group flex items-center gap-3 bg-[#145589] text-white px-8 py-4 rounded-xl font-bold transition-all hover:bg-[#0a1931] hover:shadow-xl active:scale-95">
                        Discover Our Process
                        <ion-icon name="arrow-forward-outline"
                            class="text-xl group-hover:translate-x-2 transition-transform"></ion-icon>
                    </button>

                    <div id="moreContent"
                        class="hidden p-6 bg-gray-50 border-l-4 border-[#7f03d3] rounded-r-2xl text-gray-700 italic font-medium">
                        "We believe in a Code-First, Quality-Always approach. Every pixel and every endpoint we build is a
                        step toward your business's ultimate scalability."
                    </div>
                </div>

                <div class="relative">
                    <div
                        class="absolute -z-10 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-[#7f03d3]/10 rounded-full blur-3xl">
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div
                            class="p-10 bg-white rounded-3xl shadow-[0_20px_50px_rgba(20,85,137,0.1)] text-center border border-gray-100 group hover:-translate-y-2 transition-all">
                            <div class="text-5xl font-black text-[#145589] mb-2"><span class="count"
                                    data-target="50">0</span>+</div>
                            <p class="text-gray-500 uppercase text-xs font-bold tracking-widest">Projects Scaled</p>
                        </div>
                        <div
                            class="p-10 bg-[#7f03d3] rounded-3xl shadow-[0_20px_50px_rgba(127,3,211,0.2)] text-center text-white mt-12 group hover:-translate-y-2 transition-all">
                            <div class="text-5xl font-black mb-2"><span class="count" data-target="15">0</span>+</div>
                            <p class="text-purple-100 uppercase text-xs font-bold tracking-widest">Core Engineers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-black text-[#145589]">Why Choose mdbusiness?</h2>
                <p class="text-gray-500 mt-4 font-medium uppercase tracking-widest text-sm">The mdbusiness Advantage</p>
            </div>

            <div class="grid md:grid-cols-3 gap-10">
                @php
                    $values = [
                        [
                            'icon' => 'rocket',
                            'color' => '#fd7319',
                            'title' => 'Rapid Deployment',
                            'desc' => 'Agile sprints designed to get your MVP from concept to market in record time.',
                        ],
                        [
                            'icon' => 'code-working',
                            'color' => '#145589',
                            'title' => 'Custom Solutions',
                            'desc' =>
                                'Zero templates. We build bespoke software architectures tailored to your unique workflows.',
                        ],
                        [
                            'icon' => 'infinite',
                            'color' => '#7f03d3',
                            'title' => 'Infinite Support',
                            'desc' => 'We stay with you from the first line of code to global scaling and maintenance.',
                        ],
                    ];
                @endphp

                @foreach ($values as $value)
                    <div
                        class="bg-white p-10 rounded-3xl border border-gray-100 shadow-sm hover:shadow-2xl transition-all duration-500 group">
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6 transition-transform group-hover:rotate-12"
                            style="background: {{ $value['color'] }}20">
                            <ion-icon name="{{ $value['icon'] }}-outline" class="text-3xl"
                                style="color: {{ $value['color'] }}"></ion-icon>
                        </div>
                        <h3 class="text-2xl font-bold mb-4 text-[#145589]">{{ $value['title'] }}</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $value['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="process" class="py-24 bg-gray-50 overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl md:text-5xl font-black text-[#145589] mb-4">Our Agile Workflow</h2>
                <div class="h-1.5 w-24 bg-gradient-to-r from-[#fd7319] to-[#7f03d3] mx-auto rounded-full"></div>
                <p class="mt-6 text-gray-600 text-lg">
                    We follow a rigorous, transparent, and iterative development process to ensure your project is delivered
                    on time and scales without friction.
                </p>
            </div>

            <div class="relative mb-20 bg-white p-8 rounded-3xl shadow-xl flex justify-center border border-gray-100">


                <img src="/assets/images/agile-workflow.jpg" class="h-96 justify-center" />

            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

                <div
                    class="relative p-8 bg-white rounded-2xl shadow-sm border-t-4 border-[#145589] hover:shadow-md transition-shadow">
                    <div
                        class="absolute -top-5 left-8 w-10 h-10 bg-[#145589] text-white rounded-full flex items-center justify-center font-black shadow-lg">
                        1</div>
                    <h3 class="text-xl font-bold text-[#145589] mb-3 mt-2">Discovery & Strategy</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        We dive deep into your business requirements, identifying pain points and defining a technical
                        roadmap for success.
                    </p>
                </div>

                <div
                    class="relative p-8 bg-white rounded-2xl shadow-sm border-t-4 border-[#7f03d3] hover:shadow-md transition-shadow lg:mt-6">
                    <div
                        class="absolute -top-5 left-8 w-10 h-10 bg-[#7f03d3] text-white rounded-full flex items-center justify-center font-black shadow-lg">
                        2</div>
                    <h3 class="text-xl font-bold text-[#7f03d3] mb-3 mt-2">Design & Prototype</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Our UI/UX team creates high-fidelity wireframes and interactive prototypes to visualize the user
                        journey before coding begins.
                    </p>
                </div>

                <div
                    class="relative p-8 bg-white rounded-2xl shadow-sm border-t-4 border-[#fd7319] hover:shadow-md transition-shadow">
                    <div
                        class="absolute -top-5 left-8 w-10 h-10 bg-[#fd7319] text-white rounded-full flex items-center justify-center font-black shadow-lg">
                        3</div>
                    <h3 class="text-xl font-bold text-[#fd7319] mb-3 mt-2">Iterative Development</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Using 2-week sprints, we build your solution using Flutter and Laravel, providing you with regular
                        demo updates.
                    </p>
                </div>

                <div
                    class="relative p-8 bg-white rounded-2xl shadow-sm border-t-4 border-[#145589] hover:shadow-md transition-shadow lg:mt-6">
                    <div
                        class="absolute -top-5 left-8 w-10 h-10 bg-[#145589] text-white rounded-full flex items-center justify-center font-black shadow-lg">
                        4</div>
                    <h3 class="text-xl font-bold text-[#145589] mb-3 mt-2">QA & Deployment</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Rigorous automated and manual testing ensures a bug-free launch, followed by seamless deployment to
                        cloud servers.
                    </p>
                </div>

            </div>

            <div class="mt-16 text-center">
                <p class="text-gray-500 font-medium italic mb-6">"Ready to see this process in action for your project?"</p>
                <a href="{{ url('/get-started') }}"
                    class="inline-flex items-center gap-2 bg-[#7f03d3] text-white px-8 py-3 rounded-full font-bold hover:bg-[#145589] transition-colors shadow-lg shadow-purple-200">
                    Start Your First Sprint <ion-icon name="rocket-outline"></ion-icon>
                </a>
            </div>
        </div>
    </section>



    <x-forms.inquiry-section />
@endsection
