@extends('admin.layout')

@section('title', 'Post: '.$matter->title)

@section('content')
    <a href="{{ route('admin.matters.index') }}" class="text-sm text-indigo-600 hover:underline mb-4 inline-block">&larr; Back to posts</a>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl border p-5 lg:col-span-2 space-y-4">
            <div class="flex items-start justify-between">
                <h2 class="text-lg font-semibold">{{ $matter->title }}</h2>
                <div class="flex items-center gap-2">
                    <span id="badge-{{ $matter->id }}" class="text-xs px-2 py-1 rounded-full bg-gray-100">
                        {{ $matter->controller->status ?? 'pending' }}
                    </span>
                    <a href="{{ route('admin.matters.edit', $matter) }}" class="text-xs px-2 py-1 rounded-full bg-indigo-50 text-indigo-700 hover:bg-indigo-100">Edit</a>
                </div>
            </div>

            @if ($matter->type === 'image')
                <div class="flex flex-wrap gap-3">
                    @forelse ($matter->image_urls as $url)
                        <img src="{{ $url }}" alt="{{ $matter->title }}" class="rounded-lg h-40 w-40 object-cover border">
                    @empty
                        <p class="text-sm text-gray-500">No image on file.</p>
                    @endforelse
                </div>
            @else
                <p class="text-sm text-gray-700 whitespace-pre-line">{{ $matter->payload }}</p>
            @endif

            <dl class="grid grid-cols-2 gap-4 text-sm pt-4 border-t">
                <div><dt class="text-gray-500">Owner</dt><dd>{{ $matter->matterCreator?->username ?? '—' }}</dd></div>
                <div><dt class="text-gray-500">Phone</dt><dd>{{ $matter->details?->phone ?? '—' }}</dd></div>
                <div><dt class="text-gray-500">WhatsApp</dt><dd>{{ $matter->details?->whatsapp ?? '—' }}</dd></div>
                <div><dt class="text-gray-500">Website</dt><dd>{{ $matter->details?->website ?? '—' }}</dd></div>
                <div><dt class="text-gray-500">Tags</dt><dd>{{ $matter->details?->tags ?? '—' }}</dd></div>
                <div><dt class="text-gray-500">GSTIN</dt><dd>{{ $matter->details?->gstin ?? '—' }}</dd></div>
                <div><dt class="text-gray-500">Created</dt><dd>{{ $matter->created_at->format('d M Y, H:i') }}</dd></div>
                <div><dt class="text-gray-500">Valid Until</dt><dd>{{ optional($matter->controller?->valid_until)->format('d M Y') ?? '—' }}</dd></div>
                <div>
                    <dt class="text-gray-500">City / Category</dt>
                    <dd>
                        @forelse ($matter->cityMenus as $cm)
                            {{ $cm->city?->name }} / {{ $cm->menu?->title }}@if (! $loop->last), @endif
                        @empty
                            —
                        @endforelse
                    </dd>
                </div>
            </dl>
        </div>

        <div class="bg-white rounded-xl border p-5 space-y-2">
            <h3 class="font-semibold mb-2">Moderation</h3>
            <button onclick="rowSetStatus({{ $matter->id }}, 'active')" class="w-full text-sm px-4 py-2 rounded-lg bg-green-50 text-green-700 hover:bg-green-100">Approve</button>
            <button onclick="rowSetStatus({{ $matter->id }}, 'rejected')" class="w-full text-sm px-4 py-2 rounded-lg bg-red-50 text-red-700 hover:bg-red-100">Reject</button>
            <button onclick="rowSetStatus({{ $matter->id }}, 'hold')" class="w-full text-sm px-4 py-2 rounded-lg bg-purple-50 text-purple-700 hover:bg-purple-100">Hold</button>
            <button onclick="rowSetStatus({{ $matter->id }}, 'block')" class="w-full text-sm px-4 py-2 rounded-lg bg-gray-800 text-white hover:bg-gray-900">Block</button>
            <button onclick="rowDelete({{ $matter->id }})" class="w-full text-sm px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 mt-4">Delete Post</button>
        </div>
    </div>

    @section('scripts')
        <script>
            function rowSetStatus(matterId, status) {
                const badge = document.getElementById(`badge-${matterId}`);
                const previous = badge.textContent.trim();
                badge.textContent = 'updating…';
                adminSetMatterStatus(
                    matterId,
                    status,
                    (newStatus) => { badge.textContent = newStatus; },
                    () => { badge.textContent = previous; alert('Could not update status. Please try again.'); },
                );
            }

            function rowDelete(matterId) {
                adminDeleteMatter(matterId, () => {
                    window.location.href = "{{ route('admin.matters.index') }}";
                });
            }
        </script>
    @endsection
@endsection
