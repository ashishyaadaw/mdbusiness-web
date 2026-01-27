@php
    $partners = [
        ['name' => 'MD Education', 'logo' => 'mdeducation.webp'],
        ['name' => 'One Advertisers', 'logo' => 'oneadvertisers.png'],
        ['name' => 'MD Matrimony', 'logo' => 'mdmatrimony.png'],
        ['name' => 'MD Business', 'logo' => 'logo4.png'], // Placeholder for your other brand
        ['name' => 'Websamsya Tech', 'logo' => 'logo5.png'],
        ['name' => 'Global Recruitment', 'logo' => 'logo6.png'],
    ];
@endphp

<section class="py-16 bg-white border-y border-gray-50 overflow-hidden">
    <div class="container mx-auto px-6 mb-12 text-center">
        <div
            class="inline-block px-4 py-1 rounded-full bg-[#145589]/5 text-[#145589] font-black uppercase tracking-[0.3em] text-[10px] mb-4">
            Strategic Alliances
        </div>
        <h2 class="text-2xl md:text-3xl font-black text-[#145589] tracking-tighter">Trusted by Forward-Thinking
            Enterprises</h2>
    </div>

    <div id="partner-carousel" class="splide" aria-label="Our Partners">
        <div class="splide__track">
            <ul class="splide__list items-center">
                @foreach ($partners as $partner)
                    <li class="splide__slide flex justify-center px-12 transition-all duration-500 group">
                        <div class="relative py-4">
                            <img src="{{ asset('assets/partners/' . $partner['logo']) }}" alt="{{ $partner['name'] }}"
                                class="h-10 md:h-14 w-auto object-contain filter grayscale opacity-40 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500 transform group-hover:scale-110">
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ensure Splide and AutoScroll extension are loaded
        if (typeof Splide !== 'undefined') {
            new Splide('#partner-carousel', {
                type: 'loop',
                drag: 'free',
                focus: 'center',
                perPage: 5,
                gap: '2rem',
                arrows: false,
                pagination: false,
                autoScroll: {
                    speed: 1,
                    pauseOnHover: true,
                },
                breakpoints: {
                    1024: {
                        perPage: 4
                    },
                    768: {
                        perPage: 3
                    },
                    480: {
                        perPage: 2
                    },
                }
            }).mount(window.splide.Extensions);
        }
    });
</script>
