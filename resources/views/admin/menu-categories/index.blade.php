@extends('admin.layout')

@section('title', 'Menu Categories')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <p class="text-sm text-gray-500">Categories shown on the homepage (e.g. "Popular Categories"). Order controls display order; inactive categories are hidden from the app.</p>
        <a href="{{ route('admin.menu-categories.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg whitespace-nowrap">
            + Add Category
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="bg-white rounded-xl border overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-left">
                <tr>
                    <th class="px-4 py-3">Order</th>
                    <th class="px-4 py-3">Icon</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Menus</th>
                    <th class="px-4 py-3">Active</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($categories as $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-0.5">
                                @foreach (['top' => '⤒', 'up' => '▲', 'down' => '▼', 'bottom' => '⤓'] as $direction => $icon)
                                    <form method="POST" action="{{ route('admin.menu-categories.reorder', $category) }}">
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
                            @if ($category->icon)
                                <img src="{{ $category->icon }}" alt="{{ $category->name }}" class="h-10 w-10 rounded object-cover border">
                            @else
                                <span class="h-10 w-10 rounded border bg-gray-50 flex items-center justify-center text-gray-300 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="font-medium">{{ $category->name }}</div>
                            <div class="text-xs text-gray-500">{{ $category->desc }}</div>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $category->menus_count }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs px-2 py-1 rounded-full {{ $category->flag?->menu_category ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $category->flag?->menu_category ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-1.5 justify-end">
                                <a href="{{ route('admin.menu-categories.edit', $category) }}" class="text-xs px-2 py-1 rounded bg-indigo-50 text-indigo-700 hover:bg-indigo-100">Edit</a>
                                <form method="POST" action="{{ route('admin.menu-categories.destroy', $category) }}" onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-xs px-2 py-1 rounded bg-red-50 text-red-700 hover:bg-red-100">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-6 text-center text-gray-500">No categories yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
