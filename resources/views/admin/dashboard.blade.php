@extends('admin.layout')

@section('content')
    @php
        $statusOrder = ['pending', 'active', 'inactive', 'hold', 'rejected', 'block'];
        $statusCounts = collect($statusOrder)->mapWithKeys(fn ($s) => [$s => (int) ($kpis['matters_by_status'][$s] ?? 0)]);
    @endphp

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl border p-5">
            <div class="text-sm text-gray-500">Total Users</div>
            <div class="text-2xl font-bold mt-1">{{ number_format($kpis['total_users']) }}</div>
        </div>
        <div class="bg-white rounded-xl border p-5">
            <div class="text-sm text-gray-500">Total Posts</div>
            <div class="text-2xl font-bold mt-1">{{ number_format($kpis['total_matters']) }}</div>
        </div>
        <a href="{{ route('admin.matters.index', ['status' => 'pending']) }}" class="bg-amber-50 border border-amber-200 rounded-xl p-5 hover:bg-amber-100 transition">
            <div class="text-sm text-amber-700">Pending Review</div>
            <div class="text-2xl font-bold mt-1 text-amber-800">{{ number_format($kpis['pending_matters']) }}</div>
        </a>
        <div class="bg-white rounded-xl border p-5">
            <div class="text-sm text-gray-500">Revenue (success)</div>
            <div class="text-2xl font-bold mt-1">₹{{ number_format($kpis['revenue'], 2) }}</div>
        </div>
        <div class="bg-white rounded-xl border p-5">
            <div class="text-sm text-gray-500">Total Cities</div>
            <div class="text-2xl font-bold mt-1">{{ number_format($kpis['total_cities']) }}</div>
        </div>
        <div class="bg-white rounded-xl border p-5">
            <div class="text-sm text-gray-500">Total Categories</div>
            <div class="text-2xl font-bold mt-1">{{ number_format($kpis['total_menus']) }}</div>
        </div>
        <div class="bg-white rounded-xl border p-5">
            <div class="text-sm text-gray-500">Total Transactions</div>
            <div class="text-2xl font-bold mt-1">{{ number_format($kpis['total_transactions']) }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-xl border p-5 lg:col-span-2">
            <h2 class="font-semibold mb-4">New Signups &amp; New Posts (last 30 days)</h2>
            <canvas id="trendChart" height="90"></canvas>
        </div>
        <div class="bg-white rounded-xl border p-5">
            <h2 class="font-semibold mb-4">Posts by Status</h2>
            <canvas id="statusChart" height="220"></canvas>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl border p-5">
            <h2 class="font-semibold mb-4">Recent Posts</h2>
            <div class="divide-y">
                @forelse ($recentMatters as $matter)
                    <a href="{{ route('admin.matters.show', $matter) }}" class="flex items-center justify-between py-2.5 text-sm hover:bg-gray-50 -mx-2 px-2 rounded">
                        <div>
                            <div class="font-medium">{{ $matter->title }}</div>
                            <div class="text-gray-500 text-xs">{{ $matter->matterCreator?->username }} &middot; {{ $matter->created_at->diffForHumans() }}</div>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full bg-gray-100">{{ $matter->controller->status ?? 'pending' }}</span>
                    </a>
                @empty
                    <p class="text-sm text-gray-500 py-3">No posts yet.</p>
                @endforelse
            </div>
        </div>
        <div class="bg-white rounded-xl border p-5">
            <h2 class="font-semibold mb-4">Recent Users</h2>
            <div class="divide-y">
                @forelse ($recentUsers as $user)
                    <a href="{{ route('admin.users.show', $user) }}" class="flex items-center justify-between py-2.5 text-sm hover:bg-gray-50 -mx-2 px-2 rounded">
                        <div>
                            <div class="font-medium">{{ $user->userProfile?->full_name ?? $user->username }}</div>
                            <div class="text-gray-500 text-xs">{{ $user->phone }} &middot; {{ $user->created_at->diffForHumans() }}</div>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full {{ $user->is_verified ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                            {{ $user->is_verified ? 'verified' : 'unverified' }}
                        </span>
                    </a>
                @empty
                    <p class="text-sm text-gray-500 py-3">No users yet.</p>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        const trendLabels = @json(array_keys($signupTrend));
        const signupData = @json(array_values($signupTrend));
        const matterData = @json(array_values($matterTrend));

        new Chart(document.getElementById('trendChart'), {
            type: 'line',
            data: {
                labels: trendLabels,
                datasets: [
                    { label: 'New Users', data: signupData, borderColor: '#6366f1', backgroundColor: 'rgba(99,102,241,0.1)', tension: 0.3, fill: true },
                    { label: 'New Posts', data: matterData, borderColor: '#10b981', backgroundColor: 'rgba(16,185,129,0.1)', tension: 0.3, fill: true },
                ],
            },
            options: { responsive: true, interaction: { mode: 'index', intersect: false }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } },
        });

        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: @json(array_keys($statusCounts->toArray())),
                datasets: [{
                    data: @json(array_values($statusCounts->toArray())),
                    backgroundColor: ['#f59e0b', '#10b981', '#94a3b8', '#a855f7', '#ef4444', '#374151'],
                }],
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } } },
        });
    </script>
@endsection
