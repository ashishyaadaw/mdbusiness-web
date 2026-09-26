@extends('admin.layout')

@section('title', 'Add Country')

@section('content')
    <a href="{{ route('admin.countries.index') }}" class="text-sm text-indigo-600 hover:underline mb-4 inline-block">&larr; Back to countries</a>

    <div class="bg-white rounded-xl border p-5 max-w-md">
        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.countries.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required maxlength="255" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">ISO Code <span class="text-gray-400">e.g. IND</span></label>
                <input type="text" name="iso_code" value="{{ old('iso_code') }}" required maxlength="3" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm uppercase">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-5 py-2.5 rounded-lg">Save Country</button>
                <a href="{{ route('admin.countries.index') }}" class="text-sm px-5 py-2.5 rounded-lg border text-gray-600 hover:bg-gray-50">Cancel</a>
            </div>
        </form>
    </div>
@endsection
