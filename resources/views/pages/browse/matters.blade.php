@extends('layouts.app', ['title' => $menu->title.' in '.$city->name, 'isSearchBar' => false])

@section('content')
    <div class="py-6">
        <a href="{{ route('browse.city', $city) }}" class="text-sm text-blue-600 hover:underline mb-4 inline-block">&larr; {{ $city->name }} categories</a>
        <h1 class="text-2xl font-bold text-gray-900 mb-6">{{ $menu->title }} in {{ $city->name }}</h1>

        @if ($matters->isEmpty())
            <p class="text-gray-500">No listings found for {{ $menu->title }} in {{ $city->name }} yet.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
                @foreach ($matters as $matter)
                    @include('pages.browse.partials.matter-card', ['matter' => $matter])
                @endforeach
            </div>

            {{ $matters->links() }}
        @endif
    </div>
@endsection
