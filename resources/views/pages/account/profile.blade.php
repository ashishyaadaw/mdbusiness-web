@extends('layouts.app', ['title' => 'My Profile', 'isSearchBar' => false])

@section('content')
    <div class="py-6">
        @include('pages.account.partials.nav')
        @include('pages.account.partials.flash')

        <div class="max-w-md">
            <h1 class="text-xl font-bold text-gray-900 mb-6">My Profile</h1>

            <form method="POST" action="{{ route('account.profile.update') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" value="{{ $user->username }}" disabled
                           class="w-full rounded-lg border-gray-200 bg-gray-50 text-gray-500 border px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="text" value="{{ $user->phone }}" disabled
                           class="w-full rounded-lg border-gray-200 bg-gray-50 text-gray-500 border px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $user->userProfile?->full_name) }}" required
                           class="w-full rounded-lg border-gray-300 focus:border-[#fd7319] focus:ring-[#fd7319] border px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Preferred Language</label>
                    <select name="preferred_lang" class="w-full rounded-lg border-gray-300 border px-3 py-2">
                        <option value="en" @selected(old('preferred_lang', $user->userProfile?->preferred_lang) === 'en')>English</option>
                        <option value="hi" @selected(old('preferred_lang', $user->userProfile?->preferred_lang) === 'hi')>Hindi</option>
                    </select>
                </div>

                <button type="submit" class="bg-[#fd7319] hover:bg-[#ff8533] text-white font-semibold px-6 py-2.5 rounded-lg">
                    Save Changes
                </button>
            </form>
        </div>
    </div>
@endsection
