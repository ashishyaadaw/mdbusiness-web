@extends('admin.layout')

@section('title', 'Edit Menu')

@section('content')
    <a href="{{ route('admin.menus.index') }}" class="text-sm text-indigo-600 hover:underline mb-4 inline-block">&larr; Back to menus</a>

    <div class="bg-white rounded-xl border p-5 max-w-2xl">
        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-700 px-4 py-3 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.menus.update', $menu) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title', $menu->title) }}" required maxlength="255" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="menu_category_id" required class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('menu_category_id', $menu->menu_category_id) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Changing the category moves this menu's order to the end of the new category.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                <select name="type" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
                    <option value="actual" @selected(old('type', $menu->type) === 'actual')>Actual</option>
                    <option value="ad" @selected(old('type', $menu->type) === 'ad')>Ad</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="desc" rows="2" maxlength="500" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">{{ old('desc', $menu->desc) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Icon</label>
                @if ($menu->icon)
                    <img src="{{ $menu->icon }}" alt="{{ $menu->title }}" class="h-16 w-16 rounded object-cover border mb-2">
                @endif
                <input type="file" name="icon" accept="image/png,image/jpeg,image/jpg,image/gif,image/webp" class="w-full text-sm mb-2">
                <input type="text" name="icon_url" value="{{ old('icon_url') }}" placeholder="or paste a new icon URL instead"
                       class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
                <p class="text-xs text-gray-500 mt-1">Leave both empty to keep the current icon.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Available in cities</label>
                <div class="flex flex-wrap gap-3 border rounded-lg p-3 max-h-40 overflow-y-auto">
                    @forelse ($cities as $city)
                        <label class="flex items-center gap-1.5 text-sm">
                            <input type="checkbox" name="cities[]" value="{{ $city->id }}" @checked(in_array($city->id, old('cities', $attachedCityIds)))>
                            {{ $city->name }}
                        </label>
                    @empty
                        <p class="text-xs text-gray-400">No cities yet — <a href="{{ route('admin.cities.create') }}" class="text-indigo-600 hover:underline">add one first</a>.</p>
                    @endforelse
                </div>
            </div>

            <label class="flex items-center gap-2 text-sm text-gray-600">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $menu->flag?->menus ?? true) ? 'checked' : '' }}>
                Active (visible in the app)
            </label>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-5 py-2.5 rounded-lg">Save Changes</button>
                <a href="{{ route('admin.menus.index') }}" class="text-sm px-5 py-2.5 rounded-lg border text-gray-600 hover:bg-gray-50">Cancel</a>
            </div>
        </form>
    </div>
@endsection
