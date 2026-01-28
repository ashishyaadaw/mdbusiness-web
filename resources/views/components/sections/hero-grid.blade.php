@php
    $categories = [
        ['name' => 'B2B', 'icon' => 'handshake', 'url' => '/b2b'],
        ['name' => 'Doctors', 'icon' => 'briefcase-medical', 'url' => '/doctors'],
        ['name' => 'Travel', 'icon' => 'plane', 'url' => '/travel'],
        ['name' => 'Car Hire', 'icon' => 'car', 'url' => '/car-hire'],
        ['name' => 'Beauty', 'icon' => 'sparkles', 'url' => '/beauty'],
        ['name' => 'Wedding', 'icon' => 'users', 'url' => '/wedding'],
        ['name' => 'Gyms', 'icon' => 'dumbbell', 'url' => '/gyms'],
        ['name' => 'Education', 'icon' => 'graduation-cap', 'url' => '/education'],
        ['name' => 'Packers', 'icon' => 'truck', 'url' => '/packers-movers'],
        ['name' => 'Repairs', 'icon' => 'wrench', 'url' => '/repairs'],
        ['name' => 'Rentals', 'icon' => 'key', 'url' => '/rent'],
        ['name' => 'Jobs', 'icon' => 'user-round-search', 'url' => '/jobs'],
        ['name' => 'Loans', 'icon' => 'banknote', 'url' => '/loans'],
        ['name' => 'Real Estate', 'icon' => 'house', 'url' => '/real-estate'],
        ['name' => 'PG/Hostel', 'icon' => 'bed', 'url' => '/pg-hostel'],
    ];
@endphp

<div class="w-full bg-white px-4 py-6">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-8 gap-y-6 gap-x-2 md:gap-x-4">

            @foreach ($categories as $index => $category)
                <a href="{{ $category['url'] }}"
                    class="flex flex-col items-center group transition-all duration-200
                          {{-- Mobile: Show 7 + All button | Tablet: Show 11 + All | LG: Show all --}}
                          {{ $index >= 7 ? 'display-mobile-hidden' : '' }}
                          {{ $index >= 11 ? 'md:hidden lg:flex' : 'md:flex' }}">

                    <div
                        class="w-12 h-12 md:w-14 md:h-14 flex items-center justify-center rounded-2xl bg-slate-50 mb-2 
                                transition-all group-hover:bg-blue-50 group-active:scale-95">
                        <i data-lucide="{{ $category['icon'] }}"
                            class="w-6 h-6 md:w-7 md:h-7 text-blue-600 transition-colors group-hover:text-blue-700"></i>
                    </div>

                    <span
                        class="text-[10px] md:text-xs font-semibold text-gray-600 group-hover:text-blue-600 text-center leading-tight">
                        {{ $category['name'] }}
                    </span>
                </a>
            @endforeach

            <button class="flex flex-col items-center group lg:hidden">
                <div
                    class="w-12 h-12 md:w-14 md:h-14 bg-gray-100 rounded-2xl flex items-center justify-center mb-2 
                            transition-all group-hover:bg-gray-200 group-active:scale-95">
                    <i data-lucide="layout-grid" class="w-6 h-6 text-gray-600"></i>
                </div>
                <span class="text-[10px] md:text-xs font-bold text-gray-800">All</span>
            </button>
        </div>
    </div>
</div>

<style>
    /* Helper to manage mobile visibility purely via CSS if preferred */
    @media (max-width: 639px) {
        .display-mobile-hidden {
            display: none;
        }
    }
</style>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
