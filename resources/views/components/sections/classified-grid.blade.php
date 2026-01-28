@php
    $sections = [
        [
            'title' => 'Foreign Jobs',
            'color' => 'bg-cyan-50',
            'icon_color' => 'text-cyan-600',
            'text_color' => 'text-cyan-950',
            'items' => [
                ['label' => 'Global Search', 'icon' => 'globe', 'url' => '/jobs/global'],
                ['label' => 'Visa Help', 'icon' => 'plane', 'url' => '/services/visa'],
                ['label' => 'Teach Abroad', 'icon' => 'languages', 'url' => '/jobs/teaching'],
                ['label' => 'Gulf Jobs', 'icon' => 'briefcase', 'url' => '/jobs/gulf'],
                ['label' => 'Europe Tech', 'icon' => 'monitor', 'url' => '/jobs/europe'],
                ['label' => 'Nursing', 'icon' => 'stethoscop', 'url' => '/jobs/medical'],
            ],
        ],
        [
            'title' => 'Nearby Jobs',
            'color' => 'bg-orange-50',
            'icon_color' => 'text-orange-600',
            'text_color' => 'text-orange-950',
            'items' => [
                ['label' => 'Sarkari', 'icon' => 'landmark', 'url' => '/jobs/government'],
                ['label' => 'Private', 'icon' => 'building-2', 'url' => '/jobs/private'],
                ['label' => 'Remote', 'icon' => 'home', 'url' => '/jobs/remote'],
                ['label' => 'Skilled Trades', 'icon' => 'hard-hat', 'url' => '/jobs/trades'],
                ['label' => 'Part-time', 'icon' => 'clock', 'url' => '/jobs/part-time'],
                ['label' => 'Delivery', 'icon' => 'bike', 'url' => '/jobs/delivery'],
                ['label' => 'Warehouse', 'icon' => 'package', 'url' => '/jobs/warehouse'],
                ['label' => 'IT/Software', 'icon' => 'code-2', 'url' => '/jobs/it'],
            ],
        ],
    ];
@endphp

<div class="flex-1  w-full max-w-7xl mx-auto  gap-3 py-4 bg-white overflow-hidden">
    @foreach ($sections as $section)
        <div class="{{ $section['color'] }} rounded-[2rem] p-6 mt-4 shadow-sm border border-white/60">
            <div class="flex justify-between items-center mb-8 px-2">
                <h2 class="text-xl md:text-2xl font-black {{ $section['text_color'] }} tracking-tight">
                    {{ $section['title'] }}
                </h2>
                <button class="{{ $section['text_color'] }} opacity-60 hover:opacity-100 transition-opacity">
                    <i data-lucide="chevron-up" class="w-6 h-6"></i>
                </button>
            </div>

            <div class="grid grid-cols-3 xs:grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-x-3 gap-y-8">
                @foreach ($section['items'] as $item)
                    <a href="{{ $item['url'] }}" class="flex flex-col items-center group">
                        <div class="relative">
                            <div
                                class="w-14 h-14 md:w-16 md:h-16 bg-white rounded-2xl flex items-center justify-center mb-3 shadow-md 
                                        group-hover:shadow-lg group-hover:-translate-y-1 transition-all duration-300">
                                <i data-lucide="{{ $item['icon'] }}"
                                    class="w-7 h-7 md:w-8 md:h-8 {{ $section['icon_color'] }}"></i>
                            </div>
                        </div>
                        <span
                            class="text-[11px] md:text-xs font-bold text-center text-gray-800 leading-tight px-1 group-hover:text-black">
                            {{ $item['label'] }}
                        </span>
                    </a>
                @endforeach
            </div>

            <div class="mt-8 text-center">
                <button
                    class="px-6 py-2 rounded-full bg-white/50 text-xs font-black uppercase tracking-widest {{ $section['text_color'] }} 
                               hover:bg-white transition-colors border border-transparent hover:border-white shadow-sm">
                    View All {{ $section['title'] }}
                </button>
            </div>
        </div>
    @endforeach
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
