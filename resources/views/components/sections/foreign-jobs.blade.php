@php
    $foreignJobs = [
        ['name' => 'Global Search', 'icon' => 'globe', 'route' => 'jobs.foreign.search'],
        ['name' => 'Visa Help', 'icon' => 'plane-takeoff', 'route' => 'jobs.foreign.visa'],
        ['name' => 'Teach Abroad', 'icon' => 'languages', 'route' => 'jobs.foreign.teach'],
        ['name' => 'Gulf Jobs', 'icon' => 'briefcase', 'route' => 'jobs.foreign.gulf'],
        ['name' => 'Europe Tech', 'icon' => 'monitor', 'route' => 'jobs.foreign.europe'],
        ['name' => 'Nursing', 'icon' => 'stethascope', 'route' => 'jobs.foreign.nursing'],
    ];
@endphp

<div class="mx-4 my-4 bg-[#f0f9ff] rounded-3xl p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-slate-800">Foreign Jobs</h2>
        <i data-lucide="chevron-up" class="w-5 h-5 text-slate-400"></i>
    </div>

    <div class="grid grid-cols-3 md:grid-cols-6 gap-6">
        @foreach ($foreignJobs as $job)
            <a href="{{ route($job['route']) }}" class="flex flex-col items-center group">
                <div
                    class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center shadow-sm group-active:scale-95 transition-transform">
                    <i data-lucide="{{ $job['icon'] }}" class="w-7 h-7 text-sky-500"></i>
                </div>
                <span class="mt-3 text-[11px] font-bold text-slate-700 text-center leading-tight">
                    {{ $job['name'] }}
                </span>
            </a>
        @endforeach
    </div>

    <div class="mt-8 flex justify-center">
        <button
            class="px-6 py-2 border-2 border-sky-100 text-sky-600 font-bold text-xs rounded-full uppercase tracking-wider bg-white hover:bg-sky-50 transition-colors">
            View All Foreign Jobs
        </button>
    </div>
</div>
