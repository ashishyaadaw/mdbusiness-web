@props(['slides' => collect(), 'cards' => collect()])

<div class="flex w-full max-w-7xl mx-auto flex gap-3 py-4 bg-white overflow-hidden">

    @if ($slides->isNotEmpty())
        <div class="flex-1 min-w-[300px]">
            <div id="hero-slider" class="splide" aria-label="Homepage highlights">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($slides as $slide)
                            <li class="splide__slide">
                                <div class="h-64 rounded-3xl relative overflow-hidden flex items-center p-8 border border-blue-100/50 shadow-sm bg-slate-900 bg-cover bg-center"
                                     style="background-image: url('{{ $slide->image_url }}')">
                                    <div class="absolute inset-0 bg-black/30"></div>
                                    <div class="z-10 max-w-[70%] text-white">
                                        @if ($slide->eyebrow)
                                            <span class="text-blue-300 font-bold text-xs uppercase tracking-wider">{{ $slide->eyebrow }}</span>
                                        @endif
                                        @if ($slide->heading)
                                            <h2 class="text-3xl font-extrabold leading-tight mt-1">{{ $slide->heading }}</h2>
                                        @endif
                                        @if ($slide->subheading)
                                            <p class="text-sm mt-2 mb-6 opacity-90">{{ $slide->subheading }}</p>
                                        @endif
                                        @if ($slide->button_text)
                                            <a href="{{ $slide->button_url ?: '#' }}"
                                               class="inline-block bg-yellow-500 hover:bg-yellow-400 text-black text-sm font-bold py-2 px-4 rounded transition-transform hover:scale-105 active:scale-95">
                                                {{ $slide->button_text }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @if ($slides->count() > 1)
                    <div class="splide__pagination"></div>
                @endif
            </div>
        </div>

        @push('script')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    if (typeof Splide !== 'undefined') {
                        new Splide('#hero-slider', {
                            type: @json($slides->count() > 1 ? 'loop' : 'slide'),
                            perPage: 1,
                            arrows: {{ $slides->count() > 1 ? 'true' : 'false' }},
                            pagination: {{ $slides->count() > 1 ? 'true' : 'false' }},
                            autoplay: {{ $slides->count() > 1 ? 'true' : 'false' }},
                            interval: 5000,
                        }).mount();
                    }
                });
            </script>
        @endpush
    @else
        {{-- No slides configured yet in the admin panel: keep the original static promo tile so the homepage never looks empty. --}}
        <div
            class="flex-1 min-w-[300px] h-64 bg-gradient-to-br from-slate-50 to-blue-50 rounded-3xl relative overflow-hidden flex items-center p-8 border border-blue-100/50 shadow-sm group">
            <div class="z-10 max-w-[60%]">
                <span class="text-blue-600 font-bold text-xs uppercase tracking-wider">Mobile Experience</span>
                <h2 class="text-3xl font-extrabold text-slate-800 leading-tight mt-1">
                    Download our <br> <span class="text-blue-600">Mobile App</span>
                </h2>
                <p class="text-slate-500 text-sm mt-2 mb-6">Get the best job alerts and business services on the go.</p>

                <a href="{{ route('app.open') }}" class="inline-block transition-transform hover:scale-105 active:scale-95">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                        alt="Get it on Google Play" class="h-10 md:h-12">
                </a>
            </div>

            <div
                class="absolute -right-4 top-4 h-[120%] w-1/2 rotate-12 opacity-20 md:opacity-100 transition-all group-hover:rotate-6">
                <img src="/assets/images/smartphone.png" alt="App Mockup" class="h-full object-contain drop-shadow-2xl">
            </div>

            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-blue-200/20 rounded-full blur-3xl"></div>
        </div>
    @endif

    @if ($cards->isNotEmpty())
        @foreach ($cards as $card)
            <div
                class="hidden sm:flex w-40 h-64 {{ $card->bg_class ?: 'bg-slate-900' }} rounded-2xl shrink-0 p-4 flex-col group cursor-pointer transition-all duration-300 justify-end text-white bg-cover bg-center relative overflow-hidden"
                @if ($card->image_url) style="background-image: url('{{ $card->image_url }}')" @endif>
                @if ($card->image_url)
                    <div class="absolute inset-0 bg-black/40"></div>
                @endif
                <div class="relative z-10">
                    @if ($card->eyebrow)
                        <p class="text-sm">{{ $card->eyebrow }}</p>
                    @endif
                    @if ($card->title)
                        <h3 class="font-bold transition-all duration-300 group-hover:text-xl">{{ $card->title }}</h3>
                    @endif
                    @if ($card->subtitle)
                        <p class="text-[10px] opacity-80">{{ $card->subtitle }}</p>
                    @endif
                    @if ($card->button_text)
                        <a href="{{ $card->button_url ?: '#' }}">
                            <button class="mt-2 bg-yellow-500 hover:bg-yellow-400 text-black text-[10px] font-bold py-1 px-2 rounded">
                                {{ $card->button_text }}
                            </button>
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        {{-- No service cards configured yet in the admin panel: keep the original static tiles. --}}
        <div
            class="hidden sm:flex w-40 h-64 bg-slate-900 rounded-2xl shrink-0 p-4 flex-col group cursor-pointer transition-all duration-300 justify-end text-white">
            <p class="text-sm">Looking for?</p>
            <h3 class="font-bold transition-all duration-300 group-hover:text-xl">Interior Design</h3>
            <button class="mt-2 bg-yellow-500 hover:bg-yellow-400 text-black text-[10px] font-bold py-1 px-2 rounded">Get
                Best Quotes</button>
        </div>

        <div
            class="hidden md:flex w-32 h-64 bg-blue-600 rounded-2xl shrink-0 p-4 flex-col text-white relative group cursor-pointer transition-all duration-300">
            <h3 class="font-bold transition-all duration-300 group-hover:text-2xl">B2B</h3>
            <p class="text-[10px] opacity-80">Quick Quotes</p>

            <div class="mt-auto self-start text-xl font-bold transition-all duration-300 flex items-center gap-1">
                <a href="{{ route('services.show', ['category' => 'b2b']) }}">
                    <span
                        class="max-w-0 overflow-hidden opacity-0 group-hover:max-w-[100px] group-hover:opacity-100 transition-all duration-500 text-sm uppercase tracking-wider">Explore</span>
                    <span>›</span>
                </a>
            </div>
        </div>

        <div
            class="hidden md:flex w-32 h-64 bg-blue-600 rounded-2xl shrink-0 p-4 flex-col text-white relative group cursor-pointer transition-all duration-300">
            <h3 class="font-bold transition-all duration-300 group-hover:text-xl">REPAIRS & SERVICES</h3>
            <p class="text-[10px] opacity-80">Get Nearest Vendor</p>

            <div class="mt-auto self-start text-xl font-bold transition-all duration-300 flex items-center gap-1">
                <a href="{{ route('services.show', ['category' => 'repair']) }}">
                    <span
                        class="max-w-0 overflow-hidden opacity-0 group-hover:max-w-[100px] group-hover:opacity-100 transition-all duration-500 text-sm uppercase tracking-wider">Explore</span>
                    <span>›</span>
                </a>
            </div>
        </div>

        <div
            class="hidden md:flex w-32 h-64 bg-blue-600 rounded-2xl shrink-0 p-4 flex-col text-white relative group cursor-pointer transition-all duration-300">
            <h3 class="font-bold transition-all duration-300 group-hover:text-xl">REAL ESTATE</h3>
            <p class="text-[10px] opacity-80">Finest Agents</p>

            <div class="mt-auto self-start text-xl font-bold transition-all duration-300 flex items-center gap-1">
                <a href="{{ route('services.show', ['category' => 'real-estate']) }}">
                    <span
                        class="max-w-0 overflow-hidden opacity-0 group-hover:max-w-[100px] group-hover:opacity-100 transition-all duration-500 text-sm uppercase tracking-wider">Explore</span>
                    <span>›</span>
                </a>
            </div>
        </div>
    @endif

</div>
