@extends('admin.layout')

@section('title', 'User: '.$user->username)

@section('content')
    <a href="{{ route('admin.users.index') }}" class="text-sm text-indigo-600 hover:underline mb-4 inline-block">&larr; Back to users</a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl border p-5 lg:col-span-1 space-y-4">
            <div>
                <div class="text-lg font-semibold">{{ $user->userProfile?->full_name ?? $user->username }}</div>
                <div class="text-sm text-gray-500">{{ $user->username }}</div>
            </div>
            <dl class="text-sm space-y-2">
                <div class="flex justify-between"><dt class="text-gray-500">Phone</dt><dd>{{ $user->phone }}</dd></div>
                <div class="flex justify-between"><dt class="text-gray-500">Role</dt><dd class="capitalize">{{ $user->role }}</dd></div>
                <div class="flex justify-between"><dt class="text-gray-500">Verified</dt><dd>{{ $user->is_verified ? 'Yes' : 'No' }}</dd></div>
                <div class="flex justify-between"><dt class="text-gray-500">Joined</dt><dd>{{ $user->created_at->format('d M Y') }}</dd></div>
            </dl>

            <form method="POST" action="{{ route('admin.users.verify', $user) }}">
                @csrf
                <button class="w-full text-sm px-4 py-2 rounded-lg border {{ $user->is_verified ? 'border-gray-300 text-gray-700 hover:bg-gray-50' : 'bg-green-600 text-white hover:bg-green-700 border-green-600' }}">
                    {{ $user->is_verified ? 'Mark as Unverified' : 'Mark as Verified' }}
                </button>
            </form>

            @if (auth()->user()->role === 'admin')
                <form method="POST" action="{{ route('admin.users.role', $user) }}" class="flex gap-2">
                    @csrf
                    <select name="role" class="flex-1 rounded-lg border-gray-300 border px-3 py-2 text-sm">
                        @foreach (['user', 'staff', 'admin'] as $role)
                            <option value="{{ $role }}" @selected($user->role === $role)>{{ ucfirst($role) }}</option>
                        @endforeach
                    </select>
                    <button class="text-sm px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Update Role</button>
                </form>
            @endif
        </div>

        <div class="bg-white rounded-xl border p-5 lg:col-span-2">
            <h2 class="font-semibold mb-4">Posts by this user</h2>
            <div class="divide-y">
                @forelse ($matters as $matter)
                    <a href="{{ route('admin.matters.show', $matter) }}" class="flex items-center justify-between py-2.5 text-sm hover:bg-gray-50 -mx-2 px-2 rounded">
                        <div>
                            <div class="font-medium">{{ $matter->title }}</div>
                            <div class="text-gray-500 text-xs">{{ $matter->created_at->diffForHumans() }}</div>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full bg-gray-100">{{ $matter->controller->status ?? 'pending' }}</span>
                    </a>
                @empty
                    <p class="text-sm text-gray-500 py-3">This user hasn't posted anything yet.</p>
                @endforelse
            </div>
            <div class="mt-4">{{ $matters->links() }}</div>
        </div>
    </div>
@endsection
