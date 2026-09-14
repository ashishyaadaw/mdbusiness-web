@extends('layouts.app', ['title' => 'My Dashboard', 'isSearchBar' => false])

@section('content')
    <div class="py-6">
        @include('pages.account.partials.nav')
        @include('pages.account.partials.flash')

        <h1 class="text-2xl font-bold text-gray-900 mb-1">
            Welcome, {{ $user->userProfile?->full_name ?? $user->username }}
        </h1>
        <p class="text-sm text-gray-500 mb-6">Here's a snapshot of your account.</p>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            @foreach (['active' => 'Active', 'pending' => 'Pending', 'inactive' => 'Inactive', 'rejected' => 'Rejected'] as $key => $label)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 text-center">
                    <div class="text-2xl font-black text-gray-900">{{ $statusCounts[$key] ?? 0 }}</div>
                    <div class="text-xs text-gray-500 uppercase tracking-wide mt-1">{{ $label }}</div>
                </div>
            @endforeach
        </div>

        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-gray-900">Recent Listings</h2>
            <a href="{{ route('account.matters.create') }}" class="text-sm font-semibold text-white bg-[#fd7319] px-4 py-2 rounded-full hover:bg-[#ff8533]">
                + Add Listing
            </a>
        </div>

        @if ($recentMatters->isEmpty())
            <p class="text-gray-500 mb-6">You haven't posted any listings yet.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-6">
                @foreach ($recentMatters as $matter)
                    @include('pages.browse.partials.matter-card', ['matter' => $matter, 'showStatus' => true])
                @endforeach
            </div>
        @endif

        <a href="{{ route('account.matters.index') }}" class="text-sm text-blue-600 hover:underline">View all my listings &rarr;</a>

        @if ($unreadNotifications > 0)
            <p class="text-sm text-gray-500 mt-6">
                You have <a href="{{ route('account.notifications.index') }}" class="text-blue-600 font-semibold hover:underline">{{ $unreadNotifications }} unread notification(s)</a>.
            </p>
        @endif
    </div>
@endsection
