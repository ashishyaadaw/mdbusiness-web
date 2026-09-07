@extends('admin.layout')

@section('title', 'Users')

@section('content')
    <form method="GET" class="flex flex-wrap gap-3 mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search username or phone…"
               class="rounded-lg border-gray-300 border px-3 py-2 text-sm w-64">
        <select name="role" class="rounded-lg border-gray-300 border px-3 py-2 text-sm">
            <option value="">All roles</option>
            @foreach (['user', 'staff', 'admin'] as $role)
                <option value="{{ $role }}" @selected(request('role') === $role)>{{ ucfirst($role) }}</option>
            @endforeach
        </select>
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg">Filter</button>
    </form>

    <div class="bg-white rounded-xl border overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 text-left">
                <tr>
                    <th class="px-4 py-3">User</th>
                    <th class="px-4 py-3">Phone</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Verified</th>
                    <th class="px-4 py-3">Posts</th>
                    <th class="px-4 py-3">Joined</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">{{ $user->userProfile?->full_name ?? $user->username }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $user->phone }}</td>
                        <td class="px-4 py-3">
                            <span class="text-xs px-2 py-1 rounded-full bg-gray-100">{{ $user->role }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-xs px-2 py-1 rounded-full {{ $user->is_verified ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $user->is_verified ? 'yes' : 'no' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ $user->matters_count }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.users.show', $user) }}" class="text-indigo-600 hover:underline">View</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-4 py-6 text-center text-gray-500">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $users->links() }}</div>
@endsection
