@extends('admin.layout')

@section('title', 'Add State')

@section('content')
    <a href="{{ route('admin.states.index') }}" class="text-sm text-indigo-600 hover:underline mb-4 inline-block">&larr; Back to states</a>

    <div class="bg-white rounded-xl border p-5 max-w-xl">
        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.states.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                <select name="country_id" required class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
                    <option value="">Select a country…</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}" @selected(old('country_id') == $country->id)>{{ $country->name }}</option>
                    @endforeach
                </select>
                @if ($countries->isEmpty())
                    <p class="text-xs text-gray-400 mt-1">No countries yet — <a href="{{ route('admin.countries.create') }}" class="text-indigo-600 hover:underline">add one first</a>.</p>
                @endif
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required maxlength="255" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">State Code <span class="text-gray-400">(optional)</span></label>
                <input type="text" name="state_code" value="{{ old('state_code') }}" maxlength="10" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-5 py-2.5 rounded-lg">Save State</button>
                <a href="{{ route('admin.states.index') }}" class="text-sm px-5 py-2.5 rounded-lg border text-gray-600 hover:bg-gray-50">Cancel</a>
            </div>
        </form>
    </div>
@endsection
