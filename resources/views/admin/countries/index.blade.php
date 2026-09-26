@extends('admin.layout')

@section('title', 'Countries')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <p class="text-sm text-gray-500">The top of the location hierarchy — Country → State → City.</p>
        <a href="{{ route('admin.countries.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg whitespace-nowrap">
            + Add Country
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
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">ISO Code</th>
                    <th class="px-4 py-3">States</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($countries as $country)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">{{ $country->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $country->iso_code }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $country->states_count }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-1.5 justify-end">
                                <a href="{{ route('admin.countries.edit', $country) }}" class="text-xs px-2 py-1 rounded bg-indigo-50 text-indigo-700 hover:bg-indigo-100">Edit</a>
                                <form method="POST" action="{{ route('admin.countries.destroy', $country) }}" onsubmit="return confirm('Delete this country?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-xs px-2 py-1 rounded bg-red-50 text-red-700 hover:bg-red-100">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-6 text-center text-gray-500">No countries yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
