@extends('layouts.app', [
    'title' => 'Home',
    'isSearchBar' => true,
    'bodyClass' => 'bg-slate-50',
    'activeMenu' => 'services',
])

@section('content')
    <x-sections.hero />
    <x-sections.services-grid />
    {{-- <x-sections.foreign-jobs /> --}}
    <x-sections.near-by-jobs />
    <x-sections.medium-grid />
@endsection
