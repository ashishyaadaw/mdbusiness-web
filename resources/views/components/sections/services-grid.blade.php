@php
    // Real Categories (MenuCategories), each with its real Menus — grouped
    // under the actual Category they belong to, not shown as a flat list.
    $categories = \App\Models\MenuCategories::whereHas('flag', fn ($q) => $q->where('menu_category', 1))
        ->with(['menus' => function ($q) {
            $q->whereHas('flag', fn ($f) => $f->where('menus', 1))
                ->orderBy('sort_order');
        }])
        ->orderBy('sort_order')
        ->get()
        ->filter(fn ($category) => $category->menus->isNotEmpty());

    // A small category (few menus) fits fully on one row as a static
    // wrapped grid; a large one gets a scrollable carousel instead so it
    // doesn't dominate the page — each size renders differently on purpose.
    $carouselThreshold = 6;
@endphp

@if ($categories->isNotEmpty())
    <div class="w-full bg-white px-4 py-6 border-b border-gray-100">
        <div class="max-w-7xl mx-auto space-y-8">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-extrabold text-gray-900">Popular Categories</h2>
                <a href="{{ route('browse.index') }}" class="text-sm font-semibold text-blue-600 hover:underline">Browse all</a>
            </div>

            @foreach ($categories as $category)
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-6 h-6 rounded-md overflow-hidden shrink-0 bg-blue-50 flex items-center justify-center">
                            @if ($category->icon)
                                <img src="{{ $category->icon }}" alt="" class="w-full h-full object-cover">
                            @else
                                <i data-lucide="layout-grid" class="w-3.5 h-3.5 text-blue-600"></i>
                            @endif
                        </div>
                        <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wide">{{ $category->name }}</h3>
                    </div>

                    @if ($category->menus->count() <= $carouselThreshold)
                        {{-- Small category: everything fits, so just wrap it in a static grid --}}
                        <div class="flex flex-wrap gap-4">
                            @foreach ($category->menus as $menu)
                                @include('components.sections.partials.menu-tile', ['menu' => $menu])
                            @endforeach
                        </div>
                    @else
                        {{-- Large category: too many to show at once, so scroll it as a carousel --}}
                        <div id="category-carousel-{{ $category->id }}" class="splide" aria-label="{{ $category->name }} categories">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @foreach ($category->menus as $menu)
                                        <li class="splide__slide">
                                            @include('components.sections.partials.menu-tile', ['menu' => $menu])
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="splide__arrows"></div>
                        </div>

                        @push('script')
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    if (typeof Splide !== 'undefined') {
                                        new Splide('#category-carousel-{{ $category->id }}', {
                                            type: 'slide',
                                            perPage: 7,
                                            perMove: 2,
                                            gap: '1rem',
                                            pagination: false,
                                            arrows: true,
                                            breakpoints: {
                                                1024: {
                                                    perPage: 6
                                                },
                                                768: {
                                                    perPage: 5
                                                },
                                                480: {
                                                    perPage: 3
                                                },
                                            },
                                        }).mount();
                                    }
                                });
                            </script>
                        @endpush
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endif
