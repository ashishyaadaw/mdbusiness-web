@php
    // Structured data: name, icon, route name, and the specific parameter
    $categories = [
        ['name' => 'B2B', 'icon' => 'handshake', 'route' => 'services.show', 'slug' => 'b2b'],
        ['name' => 'Doctors', 'icon' => 'briefcase-medical', 'route' => 'services.show', 'slug' => 'doctors'],
        ['name' => 'Travel', 'icon' => 'plane', 'route' => 'services.show', 'slug' => 'travel'],
        ['name' => 'Car Hire', 'icon' => 'car', 'route' => 'services.show', 'slug' => 'car-hire'],
        ['name' => 'Beauty', 'icon' => 'sparkles', 'route' => 'services.show', 'slug' => 'beauty'],
        ['name' => 'Wedding', 'icon' => 'users', 'route' => 'services.show', 'slug' => 'wedding'],
        ['name' => 'Gyms', 'icon' => 'dumbbell', 'route' => 'services.show', 'slug' => 'gyms'],
        ['name' => 'Education', 'icon' => 'graduation-cap', 'route' => 'services.show', 'slug' => 'education'],
        ['name' => 'Packers', 'icon' => 'truck', 'route' => 'services.show', 'slug' => 'packers'],
        ['name' => 'Repairs', 'icon' => 'wrench', 'route' => 'services.show', 'slug' => 'repairs'],
        ['name' => 'Rentals', 'icon' => 'key', 'route' => 'services.show', 'slug' => 'rentals'],
        ['name' => 'Loans', 'icon' => 'banknote', 'route' => 'services.show', 'slug' => 'loans'],
        ['name' => 'Real Estate', 'icon' => 'house', 'route' => 'services.show', 'slug' => 'real-estate'],
        ['name' => 'PG/Hostel', 'icon' => 'bed', 'route' => 'services.show', 'slug' => 'pg-hostel'],
    ];
@endphp

<div class="w-full bg-white px-4 py-6 border-b border-gray-100">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-8 gap-y-8 gap-x-2 md:gap-x-4">

            @foreach ($categories as $index => $category)
                <a href="{{ route($category['route'], $category['slug']) }}"
                    class="flex flex-col items-center group transition-all duration-200
                         {{ $index >= 7 ? 'hidden sm:flex' : 'flex' }} 
                         {{ $index >= 11 ? 'md:hidden lg:flex' : 'md:flex' }}">

                    <div
                        class="w-12 h-12 md:w-14 md:h-14 flex items-center justify-center rounded-2xl 
                                bg-blue-50/50 group-hover:bg-blue-600 group-hover:shadow-lg 
                                group-hover:shadow-blue-200 transition-all duration-300 group-active:scale-90">
                        <i data-lucide="{{ $category['icon'] }}"
                            class="w-6 h-6 md:w-7 md:h-7 text-blue-600 group-hover:text-white transition-colors"></i>
                    </div>

                    <span
                        class="mt-2 text-[10px] md:text-xs font-medium text-gray-500 group-hover:text-gray-900 text-center leading-tight">
                        {{ $category['name'] }}
                    </span>
                </a>
            @endforeach

            {{-- Dynamic "All" button triggers a modal or expands --}}
            <button onclick="toggleAllServices()" class="flex flex-col items-center group lg:hidden">
                <div
                    class="w-12 h-12 md:w-14 md:h-14 bg-gray-100 rounded-2xl flex items-center justify-center
                            transition-all group-hover:bg-gray-200 group-active:scale-95 shadow-sm">
                    <i data-lucide="layout-grid" class="w-6 h-6 text-gray-600"></i>
                </div>
                <span class="mt-2 text-[10px] md:text-xs font-bold text-gray-800">More</span>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        lucide.createIcons();

        function toggleAllServices() {
            // Select all elements that were hidden by default on mobile
            const hiddenItems = document.querySelectorAll('.hidden.sm\\:flex');
            hiddenItems.forEach(item => {
                item.classList.toggle('hidden');
            });
        }
    });
</script>
