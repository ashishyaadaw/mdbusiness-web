@extends('layouts.app', ['title' => $city->name, 'isSearchBar' => false])

@section('content')
    <div class="py-6">
        <a href="{{ route('browse.index') }}" class="text-sm text-blue-600 hover:underline mb-4 inline-block">&larr; All cities</a>
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Categories in {{ $city->name }}</h1>

        @if ($menus->isEmpty())
            <p class="text-gray-500">No categories are available in {{ $city->name }} yet.</p>
        @else
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($menus as $menu)
                    <a href="{{ route('browse.matters', [$city, $menu]) }}"
                       class="flex items-center gap-3 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow p-4">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center text-[#fd7319] overflow-hidden">
                            @if ($menu->icon)
                                <img src="{{ $menu->icon }}" alt="" class="w-6 h-6 object-contain">
                            @else
                                <i data-lucide="store" class="w-5 h-5"></i>
                            @endif
                        </div>
                        <span class="font-semibold text-gray-800">{{ $menu->title }}</span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection
