@extends('admin.layout')

@section('title', 'Edit Post: '.$matter->title)

@section('content')
    <a href="{{ route('admin.matters.show', $matter) }}" class="text-sm text-indigo-600 hover:underline mb-4 inline-block">&larr; Back to post</a>

    <div class="bg-white rounded-xl border p-5 max-w-3xl">
        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.matters.update', $matter) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <input type="hidden" name="type" value="{{ $matter->type }}">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title', $matter->title) }}" required maxlength="255"
                       class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
            </div>

            @if ($matter->type === 'text')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                    <textarea name="payload" rows="5" required
                              class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">{{ old('payload', $matter->payload) }}</textarea>
                </div>
            @else
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Images</label>
                    <p class="text-xs text-gray-500 mb-2">A post can hold multiple images. Uncheck one to remove it, or add new ones below.</p>

                    <div class="flex flex-wrap gap-3 mb-3">
                        @foreach ($matter->raw_image_paths as $i => $rawPath)
                            <label class="relative block">
                                <img src="{{ $matter->image_urls[$i] }}" alt="{{ $matter->title }}" class="rounded-lg h-28 w-28 object-cover border">
                                <span class="absolute bottom-1 right-1 bg-white/90 rounded px-1.5 py-0.5 text-xs flex items-center gap-1">
                                    <input type="checkbox" name="keep_images[]" value="{{ $rawPath }}" checked>
                                    keep
                                </span>
                            </label>
                        @endforeach
                    </div>

                    <input type="file" name="images[]" accept="image/png,image/jpeg,image/jpg,image/gif" multiple
                           class="w-full text-sm">
                    <p class="text-xs text-gray-500 mt-1">Up to 6 images total.</p>
                </div>
            @endif

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Contact Name</label>
                    <input type="text" name="name" value="{{ old('name', $matter->details?->name) }}"
                           class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $matter->details?->phone) }}"
                           class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $matter->details?->whatsapp) }}"
                           class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alternate Contact</label>
                    <input type="text" name="alternate_contact" value="{{ old('alternate_contact', $matter->details?->alternate_contact) }}"
                           class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                    <input type="text" name="website" value="{{ old('website', $matter->details?->website) }}"
                           class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Social Media</label>
                    <input type="text" name="social_media" value="{{ old('social_media', $matter->details?->social_media) }}"
                           class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">GSTIN</label>
                    <input type="text" name="gstin" value="{{ old('gstin', $matter->details?->gstin) }}"
                           class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Valid Until</label>
                    <input type="date" name="valid_until" value="{{ old('valid_until', optional($matter->controller?->valid_until)->format('Y-m-d')) }}"
                           class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tags <span class="text-gray-400">(comma separated)</span></label>
                <input type="text" name="tags" value="{{ old('tags', $matter->details?->tags) }}"
                       class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
            </div>

            <label class="flex items-center gap-2 text-sm text-gray-600">
                <input type="checkbox" name="is_premium" value="1" @checked(old('is_premium', $matter->controller?->is_premium))>
                Premium listing
            </label>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-5 py-2.5 rounded-lg">
                    Save Changes
                </button>
                <a href="{{ route('admin.matters.show', $matter) }}" class="text-sm px-5 py-2.5 rounded-lg border text-gray-600 hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
