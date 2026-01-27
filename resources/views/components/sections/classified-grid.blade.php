@php
    $sections = [
        [
            'title' => 'Foreign Jobs',
            'color' => 'bg-cyan-50', // Light blue background
            'items' => [
                ['label' => 'Global Search', 'icon' => 'globe', 'url' => '/jobs/global'],
                ['label' => 'Visa Assistance', 'icon' => 'plane', 'url' => '/services/visa'],
                ['label' => 'Teach Abroad', 'icon' => 'languages', 'url' => '/jobs/teaching'],
                ['label' => 'Gulf Jobs', 'icon' => 'briefcase', 'url' => '/jobs/gulf'],
            ],
        ],
        [
            'title' => 'Near by Jobs',
            'color' => 'bg-orange-50', // Light peach background
            'items' => [
                ['label' => 'Sarkari Naukari', 'icon' => 'landmark', 'url' => '/jobs/government'],
                ['label' => 'Private Jobs', 'icon' => 'building-2', 'url' => '/jobs/private'],
                ['label' => 'Work From Home', 'icon' => 'home', 'url' => '/jobs/remote'],
                ['label' => 'Skilled Trades', 'icon' => 'hard-hat', 'url' => '/jobs/trades'],
            ],
        ],
    ];
@endphp
<div class="space-y-6 p-4 max-w-xl mx-auto">
    @foreach ($sections as $section)
        <div class="{{ $section['color'] }} rounded-3xl p-5 shadow-sm border border-white/50">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-amber-900">{{ $section['title'] }}</h2>
                <button class="text-amber-900">
                    <i data-lucide="chevron-up" class="w-5 h-5"></i>
                </button>
            </div>

            <div class="grid grid-cols-4 gap-4">
                @foreach ($section['items'] as $item)
                    <a href="{{ $item['url'] }}" class="flex flex-col items-center group">
                        <div
                            class="w-14 h-14 bg-white rounded-full flex items-center justify-center mb-2 shadow-sm group-hover:scale-105 transition-transform">
                            <i data-lucide="{{ $item['icon'] }}" class="w-7 h-7 text-orange-600"></i>
                        </div>
                        <span class="text-[11px] font-bold text-center text-gray-800 leading-tight">
                            {{ $item['label'] }}
                        </span>
                    </a>
                @endforeach
            </div>

            @if ($loop->last)
                <div class="mt-6 text-center">
                    <button class="text-sm font-bold text-amber-900/70 hover:text-amber-900">See more</button>
                </div>
            @endif
        </div>
    @endforeach
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
