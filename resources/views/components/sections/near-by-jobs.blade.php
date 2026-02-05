@php
    $nearbyJobs = [
        ['name' => 'Sarkari', 'icon' => 'landmark', 'route' => 'jobs.nearby.sarkari'],
        ['name' => 'Private', 'icon' => 'building-2', 'route' => 'jobs.nearby.private'],
        ['name' => 'Remote', 'icon' => 'home', 'route' => 'jobs.nearby.remote'],
        ['name' => 'Skilled Trades', 'icon' => 'hard-hat', 'route' => 'jobs.nearby.trades'],
        ['name' => 'Part-time', 'icon' => 'clock', 'route' => 'jobs.nearby.part-time'],
        ['name' => 'Delivery', 'icon' => 'bike', 'route' => 'jobs.nearby.delivery'],
    ];
@endphp

<div class="mx-4 my-4 bg-[#fff7ed] rounded-3xl p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-orange-900">Nearby Jobs</h2>
        <i data-lucide="chevron-up" class="w-5 h-5 text-orange-300"></i>
    </div>

    <div class="grid grid-cols-3 md:grid-cols-6 gap-6">
        @foreach ($nearbyJobs as $job)
            <a href="{{ route($job['route']) }}" class="flex flex-col items-center group">
                <div
                    class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-sm group-active:scale-95 transition-transform">
                    <i data-lucide="{{ $job['icon'] }}" class="w-7 h-7 text-orange-600"></i>
                </div>
                <span class="mt-3 text-[11px] font-bold text-orange-900 text-center leading-tight">
                    {{ $job['name'] }}
                </span>
            </a>
        @endforeach
    </div>
</div>
