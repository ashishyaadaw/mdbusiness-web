@php
    $categories = [
        ['name' => 'B2B', 'icon' => 'handshake', 'url' => '/b2b'],
        ['name' => 'Doctors', 'icon' => 'briefcase-medical', 'url' => '/doctors'],
        ['name' => 'Travel', 'icon' => 'plane', 'url' => '/travel'],
        ['name' => 'Car Hire', 'icon' => 'car', 'url' => '/car-hire'],
        ['name' => 'Beauty', 'icon' => 'sparkles', 'url' => '/beauty'],
        ['name' => 'Wedding Planning', 'icon' => 'users', 'url' => '/wedding'],
        ['name' => 'Gyms', 'icon' => 'dumbbell', 'url' => '/gyms'],
        ['name' => 'Education', 'icon' => 'graduation-cap', 'url' => '/education'],
        ['name' => 'Packers & Movers', 'icon' => 'truck', 'url' => '/packers-movers'],
        ['name' => 'Repairs & Services', 'icon' => 'wrench', 'url' => '/repairs'],
        ['name' => 'Rent or Hire', 'icon' => 'key', 'url' => '/rent'],
        ['name' => 'Jobs', 'icon' => 'user-round-search', 'url' => '/jobs'],
        ['name' => 'Loans', 'icon' => 'banknote', 'url' => '/loans'],
        ['name' => 'Real Estate', 'icon' => 'house', 'url' => '/real-estate'],
        ['name' => 'PG/Hostel', 'icon' => 'bed', 'url' => '/pg-hostel'],
    ];
@endphp
<div class="space-y-6 p-4  max-w-xl mx-auto bg-white rounded-2xl">
    <div class="grid grid-cols-4 gap-y-8 gap-x-2">
        @foreach ($categories as $category)
            <a href="{{ $category['url'] }}" class="flex flex-col items-center group">
                <div class="w-12 h-12 flex items-center justify-center mb-2 transition-transform group-active:scale-90">
                    <i data-lucide="{{ $category['icon'] }}" class="w-8 h-8 text-blue-500"></i>
                </div>
                <span class="text-[11px] font-bold text-gray-800 text-center leading-tight">
                    {{ $category['name'] }}
                </span>
            </a>
        @endforeach

        <button class="flex flex-col items-center group">
            <div
                class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mb-2 transition-transform group-hover:bg-blue-600">
                <i data-lucide="chevron-down" class="w-6 h-6 text-white"></i>
            </div>
            <span class="text-[11px] font-bold text-gray-800 text-center leading-tight">
                Show More
            </span>
        </button>
    </div>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
