@php
    $matter = $matter ?? null;
    $details = $matter?->matterDetails;
    $type = old('type', $matter->type ?? 'text');
@endphp

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
    <input type="text" name="title" value="{{ old('title', $matter->title ?? '') }}" required maxlength="255"
           class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
        <select name="city_id" required class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
            <option value="">Select a city</option>
            @foreach ($cities as $city)
                <option value="{{ $city->id }}" @selected(old('city_id', $currentCityId ?? null) == $city->id)>{{ $city->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
        <select name="menu_id" required class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
            <option value="">Select a category</option>
            @foreach ($menus as $menu)
                <option value="{{ $menu->id }}" @selected(old('menu_id', $currentMenuId ?? null) == $menu->id)>{{ $menu->title }}</option>
            @endforeach
        </select>
    </div>
</div>

<div x-data="{ type: '{{ $type }}' }">
    <label class="block text-sm font-medium text-gray-700 mb-1">Listing Type</label>
    <div class="flex gap-4 mb-3 text-sm">
        <label class="flex items-center gap-2">
            <input type="radio" name="type" value="text" x-model="type" @checked($type === 'text')> Text description
        </label>
        <label class="flex items-center gap-2">
            <input type="radio" name="type" value="image" x-model="type" @checked($type === 'image')> Image(s)
        </label>
    </div>

    <div x-show="type === 'text'">
        <textarea name="payload" rows="5" placeholder="Describe your business..."
                  class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">{{ old('payload', $matter && $matter->type === 'text' ? $matter->getRawOriginal('payload') : '') }}</textarea>
    </div>

    <div x-show="type === 'image'">
        @if ($matter && $matter->type === 'image' && count($matter->image_urls))
            <p class="text-xs text-gray-500 mb-2">Existing images are kept automatically. Add more below if you like.</p>
            <div class="flex flex-wrap gap-3 mb-3">
                @foreach ($matter->image_urls as $url)
                    <img src="{{ $url }}" class="rounded-lg h-20 w-20 object-cover border">
                @endforeach
            </div>
        @endif
        <input type="file" name="images[]" accept="image/png,image/jpeg,image/jpg,image/gif,image/webp" multiple
               class="w-full text-sm">
        <p class="text-xs text-gray-500 mt-1">Up to a few images, 2MB each.</p>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Name</label>
        <input type="text" name="name" value="{{ old('name', $details?->name) }}"
               class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $details?->phone) }}"
               class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">WhatsApp</label>
        <input type="text" name="whatsapp" value="{{ old('whatsapp', $details?->whatsapp) }}"
               class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Alternate Contact</label>
        <input type="text" name="alternate_contact" value="{{ old('alternate_contact', $details?->alternate_contact) }}"
               class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
        <input type="text" name="website" value="{{ old('website', $details?->website) }}"
               class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Social Media</label>
        <input type="text" name="social_media" value="{{ old('social_media', $details?->social_media) }}"
               class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">GSTIN</label>
        <input type="text" name="gstin" value="{{ old('gstin', $details?->gstin) }}"
               class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
    </div>
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-1">Tags <span class="text-gray-400">(comma separated)</span></label>
    <input type="text" name="tags" value="{{ old('tags', $details?->tags) }}"
           class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
</div>
