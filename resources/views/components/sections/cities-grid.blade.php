@php
    $cities = \App\Models\City::whereHas('flag', fn ($q) => $q->where('city', true))
        ->orderBy('name')
        ->get();
@endphp

@if ($cities->isNotEmpty())
    <div class="w-full max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-extrabold text-gray-900">Browse by City</h2>
            <a href="{{ route('browse.index') }}" class="text-sm font-semibold text-blue-600 hover:underline">View all</a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($cities as $city)
                <a href="{{ route('browse.city', $city) }}"
                   class="flex items-center gap-3 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow p-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                        <i data-lucide="map-pin" class="w-5 h-5"></i>
                    </div>
                    <span class="font-semibold text-gray-800 truncate">{{ $city->name }}</span>
                </a>
            @endforeach
        </div>
    </div>
@endif
