@php
    $image = $matter->type === 'image' && count($matter->image_urls) ? $matter->image_urls[0] : null;
    $textPreview = $matter->type === 'text' ? \Illuminate\Support\Str::limit(trim($matter->payload ?? ''), 140) : null;
    $status = $matter->matterController?->status;
@endphp

<a href="{{ route('listings.show', $matter) }}"
   class="block bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow overflow-hidden">
    @if ($matter->type === 'image')
        <div class="bg-gray-100 flex items-center justify-center overflow-hidden">
            @if ($image)
                {{-- Auto height: the image keeps its own aspect ratio instead
                of being cropped to a fixed box. --}}
                <img src="{{ $image }}" alt="{{ $matter->title }}" class="w-full h-auto block">
            @else
                <div class="h-40 w-full flex items-center justify-center">
                    <i data-lucide="image" class="w-10 h-10 text-gray-300"></i>
                </div>
            @endif
        </div>
    @else
        {{-- Text listings get their own look — a payload preview instead of
        an empty/placeholder image box, so they read as a distinct kind of
        listing rather than an image card missing its image. --}}
        <div class="h-40 bg-blue-50/60 p-4 flex flex-col">
            <i data-lucide="file-text" class="w-5 h-5 text-blue-400 mb-2 shrink-0"></i>
            @if ($textPreview !== '')
                <p class="text-sm text-gray-600 leading-snug line-clamp-4">{{ $textPreview }}</p>
            @endif
        </div>
    @endif
    <div class="p-4">
        <div class="flex items-center justify-between gap-2 mb-1">
            <h3 class="font-bold text-gray-900 truncate">{{ $matter->title }}</h3>
            @if ($matter->matterController?->is_premium)
                <span class="shrink-0 text-[10px] font-black uppercase tracking-wide text-white bg-[#fd7319] px-2 py-0.5 rounded-full">Premium</span>
            @endif
        </div>
        @if ($matter->matterDetails?->name)
            <p class="text-sm text-gray-500 truncate">{{ $matter->matterDetails->name }}</p>
        @endif
        @if ($matter->matterDetails?->phone)
            <p class="text-sm text-blue-600 font-semibold mt-1 flex items-center gap-1">
                <i data-lucide="phone" class="w-3.5 h-3.5"></i> {{ $matter->matterDetails->phone }}
            </p>
        @endif
        @isset($showStatus)
            @if ($status)
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
            @endif
        @endisset
    </div>
</a>
