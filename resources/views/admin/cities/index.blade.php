@extends('admin.layout')

@section('title', 'Cities')

@section('content')
    <div class="flex items-center justify-between mb-4 gap-3 flex-wrap">
        <p class="text-sm text-gray-500">Cities the app operates in. Order controls display order on the homepage; inactive cities are hidden.</p>
        <a href="{{ route('admin.cities.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg whitespace-nowrap">
            + Add City
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="GET" class="flex flex-wrap gap-3 mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name…"
               class="rounded-lg border-gray-300 border px-3 py-2 text-sm w-56">
        <select name="state" class="rounded-lg border-gray-300 border px-3 py-2 text-sm">
            <option value="">All states</option>
            @foreach ($states as $state)
                <option value="{{ $state->id }}" @selected(request('state') == $state->id)>{{ $state->name }} ({{ $state->country?->name }})</option>
            @endforeach
        </select>
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg">Filter</button>
    </form>

    <div class="bg-white rounded-xl border overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-left">
                <tr>
                    <th class="px-4 py-3">Order</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">State</th>
                    <th class="px-4 py-3">Code</th>
                    <th class="px-4 py-3">Active</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($cities as $city)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-0.5">
                                @foreach (['top' => '⤒', 'up' => '▲', 'down' => '▼', 'bottom' => '⤓'] as $direction => $icon)
                                    <form method="POST" action="{{ route('admin.cities.reorder', $city) }}?{{ http_build_query(request()->query()) }}">
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
                        <td class="px-4 py-3 font-medium">{{ $city->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $city->state?->name }} @if ($city->state?->country), {{ $city->state->country->name }}@endif</td>
                        <td class="px-4 py-3 text-gray-500">{{ $city->city_code ?: '—' }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs px-2 py-1 rounded-full {{ $city->flag?->city ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ $city->flag?->city ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex gap-1.5 justify-end">
                                <a href="{{ route('admin.cities.edit', $city) }}" class="text-xs px-2 py-1 rounded bg-indigo-50 text-indigo-700 hover:bg-indigo-100">Edit</a>
                                <form method="POST" action="{{ route('admin.cities.destroy', $city) }}" onsubmit="return confirm('Delete this city?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-xs px-2 py-1 rounded bg-red-50 text-red-700 hover:bg-red-100">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-6 text-center text-gray-500">No cities yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $cities->appends(request()->query())->links() }}</div>
@endsection
