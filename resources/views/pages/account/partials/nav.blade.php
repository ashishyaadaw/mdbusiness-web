@php
    $accountLinks = [
        'account.dashboard' => ['label' => 'Dashboard', 'icon' => 'layout-dashboard'],
        'account.matters.*' => ['label' => 'My Listings', 'icon' => 'store', 'route' => 'account.matters.index'],
        'account.profile.edit' => ['label' => 'Profile', 'icon' => 'user'],
        'account.transactions.index' => ['label' => 'Transactions', 'icon' => 'receipt'],
        'account.notifications.index' => ['label' => 'Notifications', 'icon' => 'bell'],
    ];
@endphp

<nav class="flex flex-wrap gap-2 mb-6 border-b border-gray-100 pb-4">
    @foreach ($accountLinks as $pattern => $link)
        <a href="{{ route($link['route'] ?? $pattern) }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold transition-colors {{ request()->routeIs($pattern) ? 'bg-[#fd7319] text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            <i data-lucide="{{ $link['icon'] }}" class="w-4 h-4"></i>
            {{ $link['label'] }}
        </a>
    @endforeach
</nav>
