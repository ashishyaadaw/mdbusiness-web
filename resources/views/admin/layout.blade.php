<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} | MD Business Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="/assets/favicon-32x32.png">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex">

    <aside class="w-60 shrink-0 bg-gray-900 text-gray-200 min-h-screen flex flex-col">
        <div class="px-5 py-4 border-b border-gray-800">
            <span class="text-lg font-bold text-white">MD Business</span>
            <div class="text-xs text-gray-400">Admin Dashboard</div>
        </div>
        <nav class="flex-1 px-2 py-4 space-y-1 text-sm">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white' : 'hover:bg-gray-800' }}">
                <i class="fa-solid fa-gauge-high w-4"></i> Dashboard
            </a>
            <a href="{{ route('admin.matters.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('admin.matters.*') ? 'bg-indigo-600 text-white' : 'hover:bg-gray-800' }}">
                <i class="fa-solid fa-list-check w-4"></i> Posts / Matters
            </a>
            <a href="{{ route('admin.home.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('admin.home.*') ? 'bg-indigo-600 text-white' : 'hover:bg-gray-800' }}">
                <i class="fa-solid fa-images w-4"></i> Homepage
            </a>

            <div class="px-3 pt-4 pb-1 text-[11px] uppercase tracking-wider text-gray-500">Catalog</div>
            <a href="{{ route('admin.menu-categories.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('admin.menu-categories.*') ? 'bg-indigo-600 text-white' : 'hover:bg-gray-800' }}">
                <i class="fa-solid fa-folder-tree w-4"></i> Menu Categories
            </a>
            <a href="{{ route('admin.menus.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('admin.menus.*') ? 'bg-indigo-600 text-white' : 'hover:bg-gray-800' }}">
                <i class="fa-solid fa-bars w-4"></i> Menus
            </a>

            <div class="px-3 pt-4 pb-1 text-[11px] uppercase tracking-wider text-gray-500">Locations</div>
            <a href="{{ route('admin.cities.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('admin.cities.*') ? 'bg-indigo-600 text-white' : 'hover:bg-gray-800' }}">
                <i class="fa-solid fa-city w-4"></i> Cities
            </a>
            <a href="{{ route('admin.states.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('admin.states.*') ? 'bg-indigo-600 text-white' : 'hover:bg-gray-800' }}">
                <i class="fa-solid fa-map w-4"></i> States
            </a>
            <a href="{{ route('admin.countries.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('admin.countries.*') ? 'bg-indigo-600 text-white' : 'hover:bg-gray-800' }}">
                <i class="fa-solid fa-earth-americas w-4"></i> Countries
            </a>

            <div class="px-3 pt-4 pb-1 text-[11px] uppercase tracking-wider text-gray-500">Accounts</div>
            <a href="{{ route('admin.users.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-indigo-600 text-white' : 'hover:bg-gray-800' }}">
                <i class="fa-solid fa-users w-4"></i> Users
            </a>
        </nav>
        <div class="px-3 py-4 border-t border-gray-800 text-sm">
            <div class="px-3 mb-2 text-gray-400 truncate">{{ auth()->user()->username }} ({{ auth()->user()->role }})</div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="w-full text-left px-3 py-2 rounded-lg hover:bg-gray-800">
                    <i class="fa-solid fa-right-from-bracket w-4"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 min-w-0">
        <header class="bg-white border-b px-6 py-4">
            <h1 class="text-xl font-semibold">{{ $heading ?? ($title ?? 'Dashboard') }}</h1>
        </header>

        <main class="p-6">
            @if (session('status'))
                <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-800 px-4 py-3 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        async function adminSetMatterStatus(matterId, status, onDone, onError) {
            try {
                const res = await fetch(`/admin/matters/${matterId}/status`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ status }),
                });

                if (!res.ok) throw new Error('Request failed');
                const data = await res.json();
                if (onDone) onDone(data.new_status);
            } catch (e) {
                if (onError) onError(); else alert('Could not update status. Please try again.');
            }
        }

        async function adminDeleteMatter(matterId, onDone) {
            if (!confirm('Delete this post? The owner will be notified.')) return;

            try {
                const res = await fetch(`/admin/matters/${matterId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                });

                if (!res.ok) throw new Error('Request failed');
                if (onDone) onDone();
            } catch (e) {
                alert('Could not delete post. Please try again.');
            }
        }
    </script>

    @yield('scripts')

</body>
</html>
