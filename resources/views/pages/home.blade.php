@extends('layouts.app')

@section('content')
    <x-slot:title>Home | mdbusiness</x-slot>

    <x-sections.hero />
    <x-sections.hero-grid />
    <x-sections.classified-grid />
    <x-sections.medium-grid />
    {{-- <x-sections.grid2 /> --}}
@endsection
