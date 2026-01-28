<section class="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden">
    <video autoplay muted loop playsinline id="bg-video"
        class="absolute z-0 min-w-full h-full object-cover opacity-100 transition-opacity duration-1000">
        <source src="/assets/video.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="absolute inset-0 bg-gradient-to-br from-[#145589]/80 via-black/60 to-[#7f03d3]/50 z-10"></div>

    <div
        class="relative z-20 container mx-auto max-w-5xl p-12 backdrop-blur-sm border border-white/20 px-4 text-center text-white">

        <div
            class="inline-block border border-white/40 bg-white/10 px-6 py-1 rounded-full text-xs md:text-sm tracking-[0.2em] uppercase mb-8 animate-pulse">
            Next-Gen Digital Solutions
        </div>

        <div class="mb-10">
            <h2 class="text-xl md:text-2xl font-light uppercase tracking-[0.4em] mb-4 text-[#fd7319]">
                Solve. Scale. Succeed.
            </h2>
            <h1 class="text-6xl md:text-8xl font-black leading-tight mb-4 tracking-tighter">
                mdbusiness <br class="hidden md:block"> <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400">DIGITAL</span>
            </h1>
            <p class="text-lg md:text-2xl font-medium uppercase tracking-[0.2em] max-w-3xl mx-auto">
                Custom Software • AI Integration • Business Automation
            </p>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-center gap-6 mt-12">
            <a href="{{ url('/get-started') }}"
                class="w-full md:w-auto min-w-[220px] bg-[#fd7319] border-2 border-[#fd7319] py-4 px-8 text-sm font-bold uppercase tracking-widest hover:bg-transparent hover:text-white transition-all duration-300">
                Start a Project
            </a>
            <a href="{{ route('services') }}"
                class="w-full md:w-auto min-w-[220px] border-2 border-white py-4 px-8 text-sm font-bold uppercase tracking-widest hover:bg-white hover:text-[#145589] transition-all duration-300">
                Our Services
            </a>
        </div>

        <p class="mt-16 text-[10px] md:text-xs opacity-60 tracking-[0.1em] uppercase">
            Trusted by innovators in PropTech, E-commerce, and Enterprise Tech.
        </p>
    </div>
</section>
