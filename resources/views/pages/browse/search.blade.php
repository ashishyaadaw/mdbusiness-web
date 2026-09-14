@extends('layouts.app', ['title' => 'Search Results', 'isSearchBar' => false])

@section('content')
    <div class="py-6">
        <form action="{{ route('browse.search') }}" method="GET" class="flex items-center gap-2 mb-6 max-w-lg">
            <input type="text" name="q" value="{{ $term }}" placeholder="Search businesses..."
                   class="rounded-full border-gray-200 border px-4 py-2 text-sm flex-1">
            <button type="submit" class="bg-[#fd7319] text-white rounded-full p-2.5">
                <i data-lucide="search" class="w-4 h-4"></i>
            </button>
        </form>

        <h1 class="text-xl font-bold text-gray-900 mb-6">
            @if ($term !== '')
                Results for "{{ $term }}"
            @else
                All Listings
            @endif
        </h1>

        @if ($matters->isEmpty())
            <p class="text-gray-500">No listings matched your search.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
                @foreach ($matters as $matter)
                    @include('pages.browse.partials.matter-card', ['matter' => $matter])
                @endforeach
            </div>

            {{ $matters->appends(['q' => $term])->links() }}
        @endif
    </div>
@endsection
