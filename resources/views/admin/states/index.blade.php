@extends('admin.layout')

@section('title', 'States')

@section('content')
    <div class="flex items-center justify-between mb-4 gap-3 flex-wrap">
        <p class="text-sm text-gray-500">States/provinces, grouped under a country. Needed so a City can be assigned one.</p>
        <a href="{{ route('admin.states.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg whitespace-nowrap">
            + Add State
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="GET" class="flex flex-wrap gap-3 mb-4">
        <select name="country" class="rounded-lg border-gray-300 border px-3 py-2 text-sm">
            <option value="">All countries</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}" @selected(request('country') == $country->id)>{{ $country->name }}</option>
            @endforeach
        </select>
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg">Filter</button>
    </form>

    <div class="bg-white rounded-xl border overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-left">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Country</th>
                    <th class="px-4 py-3">Code</th>
                    <th class="px-4 py-3">Cities</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($states as $state)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">{{ $state->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $state->country?->name ?? '—' }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $state->state_code ?: '—' }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $state->cities_count }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-1.5 justify-end">
                                <a href="{{ route('admin.states.edit', $state) }}" class="text-xs px-2 py-1 rounded bg-indigo-50 text-indigo-700 hover:bg-indigo-100">Edit</a>
                                <form method="POST" action="{{ route('admin.states.destroy', $state) }}" onsubmit="return confirm('Delete this state?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-xs px-2 py-1 rounded bg-red-50 text-red-700 hover:bg-red-100">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-6 text-center text-gray-500">No states yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $states->appends(request()->query())->links() }}</div>
@endsection
