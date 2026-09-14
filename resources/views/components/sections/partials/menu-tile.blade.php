<a href="{{ route('browse.category', $menu) }}" class="flex flex-col items-center group w-20">
    <div
        class="w-14 h-14 rounded-2xl overflow-hidden flex items-center justify-center
                bg-blue-50/50 group-hover:shadow-lg group-hover:shadow-blue-200 transition-all duration-300 group-active:scale-90">
        @if ($menu->icon)
            <img src="{{ $menu->icon }}" alt="{{ $menu->title }}" class="w-full h-full object-cover">
        @else
            <i data-lucide="store" class="w-6 h-6 text-blue-600"></i>
        @endif
    </div>
    <span class="mt-2 text-[10px] font-medium text-gray-500 group-hover:text-gray-900 text-center leading-tight">
        {{ $menu->title }}
    </span>
</a>
