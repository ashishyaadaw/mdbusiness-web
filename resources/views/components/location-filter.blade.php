@props([
    'states' => ['Uttar Pradesh', 'Delhi', 'Maharashtra'],
    'activeState' => 'Uttar Pradesh',
    'cities' => ['Gorakhpur', 'Lucknow', 'Kanpur'],
    'activeCity' => 'Gorakhpur',
])

<div x-data="{ open: false, selectedState: '{{ $activeState }}' }"
    class="flex items-center w-full overflow-hidden bg-white border border-gray-200 shadow-sm rounded-2xl h-14">

    <div class="relative h-full shrink-0">
        <button @click="open = !open" @click.away="open = false"
            class="flex items-center h-full px-4 text-white bg-pink-600 hover:bg-pink-700 transition-colors focus:outline-none">
            <i data-lucide="target" class="w-5 h-5 mr-2"></i>
            <span class="text-sm font-bold whitespace-nowrap" x-text="selectedState"></span>
            <i data-lucide="chevron-down" class="w-4 h-4 ml-2 transition-transform"
                :class="open ? 'rotate-180' : ''"></i>
        </button>

        <div x-show="open" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            class="absolute left-0 z-50 w-48 mt-2 bg-white border border-gray-200 rounded-lg shadow-xl top-full">
            @foreach ($states as $state)
                <a href="?state={{ urlencode($state) }}"
                    class="block px-4 py-3 text-sm text-gray-700 hover:bg-pink-50 hover:text-pink-700 {{ $state == $activeState ? 'bg-pink-50 font-bold' : '' }}">
                    {{ $state }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="flex items-center h-full overflow-x-auto no-scrollbar flex-grow bg-gray-50">
        @foreach ($cities as $city)
            <a href="?state={{ urlencode($activeState) }}&city={{ urlencode($city) }}" @class([
                'relative flex items-center h-full px-6 shrink-0 cursor-pointer transition-colors',
                'bg-white text-pink-700 font-bold' => $city == $activeCity,
                'text-gray-500 font-medium hover:bg-gray-100' => $city != $activeCity,
            ])>
                {{ $city }}
                @if ($city == $activeCity)
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-pink-600"></div>
                @endif
            </a>
        @endforeach
    </div>
</div>

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
