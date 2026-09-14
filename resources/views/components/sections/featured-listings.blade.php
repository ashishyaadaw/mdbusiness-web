@php
    $featuredMatters = \App\Models\Matters\Matter::whereHas('matterController', fn ($q) => $q->where('status', 'active'))
        ->with(['matterDetails', 'matterController'])
        ->join('matter_controller', 'matter_controller.matter_id', '=', 'matters.id')
        ->select('matters.*')
        ->orderByDesc('matter_controller.is_premium')
        ->orderByDesc('matters.created_at')
        ->limit(9)
        ->get();
@endphp

@if ($featuredMatters->isNotEmpty())
    <div class="w-full max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-extrabold text-gray-900">Recent Listings</h2>
            <a href="{{ route('browse.search') }}" class="text-sm font-semibold text-blue-600 hover:underline">View all</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($featuredMatters as $matter)
                @include('pages.browse.partials.matter-card', ['matter' => $matter])
            @endforeach
        </div>
    </div>
@endif
