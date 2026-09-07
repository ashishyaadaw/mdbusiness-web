@extends('admin.layout')

@section('title', 'Posts / Matters')

@section('content')
    @php $tabs = ['pending', 'active', 'inactive', 'hold', 'rejected', 'block', 'all']; @endphp

    <div class="flex flex-wrap gap-2 mb-4">
        @foreach ($tabs as $tab)
            <a href="{{ route('admin.matters.index', array_merge(request()->except(['status', 'page']), ['status' => $tab])) }}"
               class="text-sm px-3 py-1.5 rounded-full border {{ $status === $tab ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-white text-gray-600 hover:bg-gray-50' }}">
                {{ ucfirst($tab) }}
            </a>
        @endforeach
    </div>

    <form method="GET" class="flex flex-wrap gap-3 mb-4">
        <input type="hidden" name="status" value="{{ $status }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title…"
               class="rounded-lg border-gray-300 border px-3 py-2 text-sm w-56">
        <select name="city" class="rounded-lg border-gray-300 border px-3 py-2 text-sm">
            <option value="">All cities</option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}" @selected(request('city') == $city->id)>{{ $city->name }}</option>
            @endforeach
        </select>
        <select name="menu" class="rounded-lg border-gray-300 border px-3 py-2 text-sm">
            <option value="">All categories</option>
            @foreach ($menus as $menu)
                <option value="{{ $menu->id }}" @selected(request('menu') == $menu->id)>{{ $menu->title }}</option>
            @endforeach
        </select>
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg">Filter</button>
    </form>

    <div class="bg-white rounded-xl border overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-left">
                <tr>
                    <th class="px-4 py-3">Order</th>
                    <th class="px-4 py-3">Payload</th>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Owner</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Created</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($matters as $matter)
                    <tr id="row-{{ $matter->id }}" class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-0.5">
                                @foreach (['top' => '⤒', 'up' => '▲', 'down' => '▼', 'bottom' => '⤓'] as $direction => $icon)
                                    <form method="POST" action="{{ route('admin.matters.reorder', $matter) }}?{{ http_build_query(request()->query()) }}">
                                        @csrf
                                        <input type="hidden" name="direction" value="{{ $direction }}">
                                        <button type="submit" title="Move {{ $direction }}"
                                                class="w-6 h-6 flex items-center justify-center rounded border text-gray-500 hover:bg-gray-100 hover:text-gray-800 text-xs">
                                            {{ $icon }}
                                        </button>
                                    </form>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            @if ($matter->type === 'image')
                                @if ($matter->image_urls)
                                    <a href="{{ route('admin.matters.show', $matter) }}">
                                        <img src="{{ $matter->image_urls[0] }}" alt="{{ $matter->title }}" class="h-10 w-10 rounded object-cover border">
                                    </a>
                                    @if (count($matter->image_urls) > 1)
                                        <span class="text-xs text-gray-400">+{{ count($matter->image_urls) - 1 }}</span>
                                    @endif
                                @else
                                    <span class="h-10 w-10 rounded border bg-gray-50 flex items-center justify-center text-gray-300 text-xs">—</span>
                                @endif
                            @else
                                <span class="text-xs text-gray-500 block max-w-40 truncate" title="{{ $matter->payload }}">
                                    {{ \Illuminate\Support\Str::limit($matter->payload, 40) }}
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ route('admin.matters.show', $matter) }}" class="font-medium hover:underline">{{ $matter->title }}</a>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $matter->matterCreator?->username ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <span id="badge-{{ $matter->id }}" class="text-xs px-2 py-1 rounded-full bg-gray-100">
                                {{ $matter->controller->status ?? 'pending' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $matter->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap gap-1.5 justify-end">
                                <a href="{{ route('admin.matters.edit', $matter) }}" class="text-xs px-2 py-1 rounded bg-indigo-50 text-indigo-700 hover:bg-indigo-100">Edit</a>
                                <button onclick="rowSetStatus({{ $matter->id }}, 'active')" class="text-xs px-2 py-1 rounded bg-green-50 text-green-700 hover:bg-green-100">Approve</button>
                                <button onclick="rowSetStatus({{ $matter->id }}, 'rejected')" class="text-xs px-2 py-1 rounded bg-red-50 text-red-700 hover:bg-red-100">Reject</button>
                                <button onclick="rowSetStatus({{ $matter->id }}, 'hold')" class="text-xs px-2 py-1 rounded bg-purple-50 text-purple-700 hover:bg-purple-100">Hold</button>
                                <button onclick="rowSetStatus({{ $matter->id }}, 'block')" class="text-xs px-2 py-1 rounded bg-gray-800 text-white hover:bg-gray-900">Block</button>
                                <button onclick="rowDelete({{ $matter->id }})" class="text-xs px-2 py-1 rounded bg-red-600 text-white hover:bg-red-700">Delete</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-4 py-6 text-center text-gray-500">No posts in this status.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $matters->appends(request()->query())->links() }}</div>

    @section('scripts')
        <script>
            function rowSetStatus(matterId, status) {
                const badge = document.getElementById(`badge-${matterId}`);
                const previous = badge.textContent.trim();
                badge.textContent = 'updating…';
                adminSetMatterStatus(
                    matterId,
                    status,
                    (newStatus) => { badge.textContent = newStatus; },
                    () => { badge.textContent = previous; alert('Could not update status. Please try again.'); },
                );
            }

            function rowDelete(matterId) {
                adminDeleteMatter(matterId, () => {
                    document.getElementById(`row-${matterId}`)?.remove();
                });
            }
        </script>
    @endsection
@endsection
