@php
    $pageContent = [
        'tourist_places' => [
            'title' => 'Explore Top Tourist Places',
            'items' => [
                ['name' => 'Srinagar', 'image' => 'srinagar.jpg', 'url' => '/explore/srinagar'],
                ['name' => 'Amritsar', 'image' => 'amritsar.jpg', 'url' => '/explore/amritsar'],
                ['name' => 'Mcleodganj', 'image' => 'mcleodganj.jpg', 'url' => '/explore/mcleodganj'],
                ['name' => 'Manali', 'image' => 'manali.jpg', 'url' => '/explore/manali'],
            ],
        ],
        'rent_hire' => [
            'title' => 'Rent & Hire',
            'items' => [
                ['name' => 'Hire Vehicles', 'image' => 'coming-soon.avif', 'url' => '/rent/vehicles'],
                ['name' => 'Rent Clothes', 'image' => 'clothes.jpg', 'url' => '/rent/clothes'],
                ['name' => 'Rent Furniture', 'image' => 'furniture.jpg', 'url' => '/rent/furniture'],
                ['name' => 'Rent Appliance', 'image' => 'appliances.jpg', 'url' => '/rent/appliances'],
            ],
        ],
    ];
@endphp
<div class="p-4 space-y-10 bg-white">
    @foreach ($pageContent as $section)
        <section>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-900">{{ $section['title'] }}</h2>
                <a href="#" class="text-gray-400">
                    <i data-lucide="chevron-right" class="w-6 h-6"></i>
                </a>
            </div>

            <div class="flex gap-4 overflow-x-auto snap-x no-scrollbar pb-2">
                @foreach ($section['items'] as $item)
                    <a href="{{ $item['url'] }}"
                        class="relative flex-shrink-0 w-40 h-52 overflow-hidden rounded-2xl snap-start group">

                        <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}"
                            class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>

                        <div class="absolute bottom-4 left-4 right-4">
                            <p class="text-xs font-black leading-tight text-white uppercase tracking-wider">
                                {{ $item['name'] }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endforeach
</div>

<style>
    /* Utility to hide scrollbar but keep functionality */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
