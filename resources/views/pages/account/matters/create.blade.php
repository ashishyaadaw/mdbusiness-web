@extends('layouts.app', ['title' => 'Add Listing', 'isSearchBar' => false])

@section('content')
    <div class="py-6">
        @include('pages.account.partials.nav')

        <div class="max-w-2xl">
            <h1 class="text-xl font-bold text-gray-900 mb-6">Add a Listing</h1>

            @include('pages.account.partials.flash')

            <form method="POST" action="{{ route('account.matters.store') }}" enctype="multipart/form-data" class="space-y-4 bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                @csrf
                @include('pages.account.matters.partials.fields')

                <button type="submit" class="bg-[#fd7319] hover:bg-[#ff8533] text-white font-semibold px-6 py-2.5 rounded-lg">
                    Submit for Review
                </button>
            </form>
        </div>
    </div>
@endsection
