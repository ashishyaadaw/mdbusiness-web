@extends('layouts.app', [
    'title' => 'Home',
    'isSearchBar' => false,
    'bodyClass' => 'bg-slate-50',
    'activeMenu' => 'services',
])

@section('content')
    <x-sections.hero :slides="$heroSlides ?? collect()" :cards="$homeServiceCards ?? collect()" />
    <x-sections.services-grid />
    <x-sections.cities-grid />
    <x-sections.featured-listings />
@endsection
