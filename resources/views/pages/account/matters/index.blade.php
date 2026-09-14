@extends('layouts.app', ['title' => 'My Listings', 'isSearchBar' => false])

@section('content')
    <div class="py-6">
        @include('pages.account.partials.nav')
        @include('pages.account.partials.flash')

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-gray-900">My Listings</h1>
            <a href="{{ route('account.matters.create') }}" class="text-sm font-semibold text-white bg-[#fd7319] px-4 py-2 rounded-full hover:bg-[#ff8533]">
                + Add Listing
            </a>
        </div>

        @if ($matters->isEmpty())
            <p class="text-gray-500">You haven't posted any listings yet.</p>
        @else
            <div class="space-y-4">
                @foreach ($matters as $matter)
                    @php
                        $cityMenu = $matter->cityMenuMatter->first()?->cityMenu;
                        $status = $matter->matterController?->status ?? 'pending';
                    @endphp
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex flex-col sm:flex-row sm:items-center gap-4">
                        <div class="w-16 h-16 rounded-xl bg-gray-100 flex items-center justify-center overflow-hidden shrink-0">
                            @if ($matter->type === 'image' && count($matter->image_urls))
                                <img src="{{ $matter->image_urls[0] }}" class="w-full h-full object-cover">
                            @else
                                <i data-lucide="file-text" class="w-6 h-6 text-gray-300"></i>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <a href="{{ route('listings.show', $matter) }}" class="font-semibold text-gray-900 hover:underline truncate block">{{ $matter->title }}</a>
                            <p class="text-xs text-gray-500 mt-0.5">
                                {{ $cityMenu?->menu?->title ?? 'No category' }} &middot; {{ $cityMenu?->city?->name ?? 'No city' }}
                            </p>
                            <span class="inline-block mt-2 text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full
                                {{ match($status) {
                                    'active' => 'bg-green-100 text-green-700',
                                    'inactive' => 'bg-gray-100 text-gray-600',
                                    'pending' => 'bg-amber-100 text-amber-700',
                                    'rejected', 'block' => 'bg-red-100 text-red-700',
                                    default => 'bg-gray-100 text-gray-600',
                                } }}">
                                {{ ucfirst($status) }}
                            </span>
                        </div>

                        <div class="flex flex-wrap items-center gap-2 shrink-0">
                            @if (in_array($status, ['active', 'inactive']))
                                <form method="POST" action="{{ route($status === 'active' ? 'account.matters.inactivate' : 'account.matters.activate', $matter) }}">
                                    @csrf
                                    <button type="submit" class="text-xs font-semibold px-3 py-1.5 rounded-full border border-gray-200 text-gray-600 hover:bg-gray-50">
                                        {{ $status === 'active' ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('account.matters.edit', $matter) }}" class="text-xs font-semibold px-3 py-1.5 rounded-full border border-gray-200 text-gray-600 hover:bg-gray-50">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('account.matters.destroy', $matter) }}" onsubmit="return confirm('Delete this listing? This cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-semibold px-3 py-1.5 rounded-full border border-red-200 text-red-600 hover:bg-red-50">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">{{ $matters->links() }}</div>
        @endif
    </div>
@endsection
