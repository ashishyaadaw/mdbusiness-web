@extends('admin.layout')

@section('title', 'Add Menu')

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

        <form method="POST" action="{{ route('admin.menus.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required maxlength="255" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="menu_category_id" required class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
                    <option value="">Select a category…</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('menu_category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
                @if ($categories->isEmpty())
                    <p class="text-xs text-gray-400 mt-1">No categories yet — <a href="{{ route('admin.menu-categories.create') }}" class="text-indigo-600 hover:underline">add one first</a>.</p>
                @endif
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                <select name="type" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
                    <option value="actual" @selected(old('type', 'actual') === 'actual')>Actual</option>
                    <option value="ad" @selected(old('type') === 'ad')>Ad</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="desc" rows="2" maxlength="500" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">{{ old('desc') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Icon</label>
                <input type="file" name="icon" accept="image/png,image/jpeg,image/jpg,image/gif,image/webp" class="w-full text-sm mb-2">
                <input type="text" name="icon_url" value="{{ old('icon_url') }}" placeholder="or paste an icon URL instead"
                       class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
                <p class="text-xs text-gray-500 mt-1">Upload a file, or paste a URL. If both are given, the uploaded file wins.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Available in cities</label>
                <div class="flex flex-wrap gap-3 border rounded-lg p-3 max-h-40 overflow-y-auto">
                    @forelse ($cities as $city)
                        <label class="flex items-center gap-1.5 text-sm">
                            <input type="checkbox" name="cities[]" value="{{ $city->id }}" @checked(in_array($city->id, old('cities', [])))>
                            {{ $city->name }}
                        </label>
                    @empty
                        <p class="text-xs text-gray-400">No cities yet — <a href="{{ route('admin.cities.create') }}" class="text-indigo-600 hover:underline">add one first</a>.</p>
                    @endforelse
                </div>
            </div>

            <label class="flex items-center gap-2 text-sm text-gray-600">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                Active (visible in the app)
            </label>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-5 py-2.5 rounded-lg">Save Menu</button>
                <a href="{{ route('admin.menus.index') }}" class="text-sm px-5 py-2.5 rounded-lg border text-gray-600 hover:bg-gray-50">Cancel</a>
            </div>
        </form>
    </div>
@endsection
