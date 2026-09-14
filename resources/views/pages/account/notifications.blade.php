@extends('layouts.app', ['title' => 'Notifications', 'isSearchBar' => false])

@section('content')
    <div class="py-6">
        @include('pages.account.partials.nav')
        @include('pages.account.partials.flash')

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-gray-900">Notifications</h1>
            @if ($notifications->contains(fn ($n) => is_null($n->read_at)))
                <form method="POST" action="{{ route('account.notifications.readAll') }}">
                    @csrf
                    <button type="submit" class="text-sm text-blue-600 hover:underline">Mark all as read</button>
                </form>
            @endif
        </div>

        @if ($notifications->isEmpty())
            <p class="text-gray-500">You don't have any notifications yet.</p>
        @else
            <div class="space-y-3">
                @foreach ($notifications as $notification)
                    <div class="bg-white rounded-2xl border {{ $notification->read_at ? 'border-gray-100' : 'border-[#fd7319]/40' }} shadow-sm p-4 flex items-start justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="font-semibold text-gray-900">{{ $notification->title }}</h3>
                                @unless ($notification->read_at)
                                    <span class="w-2 h-2 rounded-full bg-[#fd7319]"></span>
                                @endunless
                            </div>
                            <p class="text-sm text-gray-600 mt-1">{{ $notification->body }}</p>
                            <p class="text-xs text-gray-400 mt-2">{{ $notification->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                        @unless ($notification->read_at)
                            <form method="POST" action="{{ route('account.notifications.read', $notification) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-xs text-blue-600 hover:underline whitespace-nowrap">Mark read</button>
                            </form>
                        @endunless
                    </div>
                @endforeach
            </div>

            <div class="mt-4">{{ $notifications->links() }}</div>
        @endif
    </div>
@endsection
