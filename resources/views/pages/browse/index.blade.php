@extends('layouts.app', ['title' => 'Browse Cities', 'isSearchBar' => false])

@section('content')
    <div class="py-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Browse by City</h1>
            <form action="{{ route('browse.search') }}" method="GET" class="flex items-center gap-2">
                <input type="text" name="q" placeholder="Search businesses..."
                       class="rounded-full border-gray-200 border px-4 py-2 text-sm w-56">
                <button type="submit" class="bg-[#fd7319] text-white rounded-full p-2.5">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </button>
            </form>
        </div>

        @if ($cities->isEmpty())
            <p class="text-gray-500">No cities are available right now. Please check back soon.</p>
        @else
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($cities as $city)
                    <a href="{{ route('browse.city', $city) }}"
                       class="flex items-center gap-3 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow p-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                            <i data-lucide="map-pin" class="w-5 h-5"></i>
                        </div>
                        <span class="font-semibold text-gray-800">{{ $city->name }}</span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
