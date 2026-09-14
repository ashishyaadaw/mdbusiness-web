@extends('layouts.app', ['title' => 'Edit Listing', 'isSearchBar' => false])

@section('content')
    <div class="py-6">
        @include('pages.account.partials.nav')

        <div class="max-w-2xl">
            <h1 class="text-xl font-bold text-gray-900 mb-1">Edit Listing</h1>
            <p class="text-sm text-gray-500 mb-6">Saving changes sends this listing back for admin review.</p>

            @include('pages.account.partials.flash')

            <form method="POST" action="{{ route('account.matters.update', $matter) }}" enctype="multipart/form-data" class="space-y-4 bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                @csrf
                @method('PUT')
                @include('pages.account.matters.partials.fields', ['matter' => $matter])

                <button type="submit" class="bg-[#fd7319] hover:bg-[#ff8533] text-white font-semibold px-6 py-2.5 rounded-lg">
                    Save & Resubmit
                </button>
            </form>
        </div>
    </div>
@endsection
