@php
    $pageSections = [
        [
            'title' => 'Explore Top Tourist Places',
            'link' => '/tourist-places',
            'items' => [
                ['name' => 'SRINAGAR', 'image' => 'srinagar.jpg', 'url' => '/travel/srinagar'],
                ['name' => 'AMRITSAR', 'image' => 'amritsar.jpg', 'url' => '/travel/amritsar'],
                ['name' => 'MCLEODGANJ', 'image' => 'mcleodganj.jpg', 'url' => '/travel/mcleodganj'],
                ['name' => 'MANALI', 'image' => 'manali.jpg', 'url' => '/travel/manali'],
            ],
        ],
        [
            'title' => 'Rent & Hire',
            'link' => '/rent-and-hire',
            'items' => [
                ['name' => 'HIRE VEHICLES', 'image' => 'car.jpg', 'url' => '/rent/vehicles'],
                ['name' => 'RENT CLOTHES', 'image' => 'clothes.jpg', 'url' => '/rent/clothes'],
                ['name' => 'RENT FURNITURE', 'image' => 'furniture.jpg', 'url' => '/rent/furniture'],
                ['name' => 'RENT APPLIANCE', 'image' => 'washer.jpg', 'url' => '/rent/appliances'],
            ],
        ],
    ];
@endphp
<div class="space-y-8 p-4 bg-gray-50">
    @foreach ($pageSections as $section)
        <section>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-extrabold text-gray-900">{{ $section['title'] }}</h2>
                <a href="{{ $section['link'] }}" class="text-gray-600">
                    <i data-lucide="chevron-right" class="w-6 h-6"></i>
                </a>
            </div>

            <div class="flex overflow-x-auto gap-3 no-scrollbar pb-2">
                @foreach ($section['items'] as $item)
                    <a href="{{ $item['url'] }}"
                        class="relative flex-shrink-0 w-36 h-48 rounded-xl overflow-hidden shadow-sm group">
                        <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent">
                        </div>

                        <div class="absolute bottom-3 left-3 right-3">
                            <span class="text-xs font-black text-white leading-tight uppercase tracking-wide">
                                {{ $item['name'] }}
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endforeach
</div>

<style>
    /* Utility to hide scrollbars while keeping functionality */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
