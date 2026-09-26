@extends('admin.layout')

@section('title', 'Menus')

@section('content')
    <div class="flex items-center justify-between mb-4 gap-3 flex-wrap">
        <p class="text-sm text-gray-500">Items within a category (e.g. "Interior Design" under "Home Services"). Order is per-category; inactive menus are hidden from the app.</p>
        <a href="{{ route('admin.menus.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg whitespace-nowrap">
            + Add Menu
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="GET" class="flex flex-wrap gap-3 mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title…"
               class="rounded-lg border-gray-300 border px-3 py-2 text-sm w-56">
        <select name="category" class="rounded-lg border-gray-300 border px-3 py-2 text-sm">
            <option value="">All categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg">Filter</button>
    </form>

    <div class="bg-white rounded-xl border overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-left">
                <tr>
                    <th class="px-4 py-3">Order</th>
                    <th class="px-4 py-3">Icon</th>
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Category</th>
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3">Active</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($menus as $menu)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-0.5">
                                @foreach (['top' => '⤒', 'up' => '▲', 'down' => '▼', 'bottom' => '⤓'] as $direction => $icon)
                                    <form method="POST" action="{{ route('admin.menus.reorder', $menu) }}?{{ http_build_query(request()->query()) }}">
                                        @csrf
                                        <input type="hidden" name="direction" value="{{ $direction }}">
                                        <button type="submit" title="Move {{ $direction }} (within category)"
                                                class="w-6 h-6 flex items-center justify-center rounded border text-gray-500 hover:bg-gray-100 hover:text-gray-800 text-xs">
                                            {{ $icon }}
                                        </button>
                                    </form>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            @if ($menu->icon)
                                <img src="{{ $menu->icon }}" alt="{{ $menu->title }}" class="h-10 w-10 rounded object-cover border">
                            @else
                                <span class="h-10 w-10 rounded border bg-gray-50 flex items-center justify-center text-gray-300 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-medium">{{ $menu->title }}</div>
                            <div class="text-xs text-gray-500">{{ $menu->desc }}</div>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $menu->category?->name ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs px-2 py-1 rounded-full bg-gray-100 text-gray-600">{{ $menu->type }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-xs px-2 py-1 rounded-full {{ $menu->flag?->menus ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $menu->flag?->menus ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-1.5 justify-end">
                                <a href="{{ route('admin.menus.edit', $menu) }}" class="text-xs px-2 py-1 rounded bg-indigo-50 text-indigo-700 hover:bg-indigo-100">Edit</a>
                                <form method="POST" action="{{ route('admin.menus.destroy', $menu) }}" onsubmit="return confirm('Delete this menu?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-xs px-2 py-1 rounded bg-red-50 text-red-700 hover:bg-red-100">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-4 py-6 text-center text-gray-500">No menus yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $menus->appends(request()->query())->links() }}</div>
@endsection
