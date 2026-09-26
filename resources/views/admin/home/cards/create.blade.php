@extends('admin.layout')

@section('title', 'Add Service Card')

@section('content')
    <a href="{{ route('admin.home.index') }}" class="text-sm text-indigo-600 hover:underline mb-4 inline-block">&larr; Back to homepage content</a>

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

        <form method="POST" action="{{ route('admin.home.cards.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Image <span class="text-gray-400">(optional — falls back to background color)</span></label>
                <input type="file" name="image" accept="image/png,image/jpeg,image/jpg,image/gif,image/webp" class="w-full text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Background Color Class <span class="text-gray-400">(Tailwind class, e.g. bg-slate-900, bg-blue-600)</span></label>
                <input type="text" name="bg_class" value="{{ old('bg_class', 'bg-slate-900') }}" maxlength="100" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Eyebrow <span class="text-gray-400">e.g. "Looking for?"</span></label>
                <input type="text" name="eyebrow" value="{{ old('eyebrow') }}" maxlength="255" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-gray-400">e.g. "Interior Design"</span></label>
                <input type="text" name="title" value="{{ old('title') }}" maxlength="255" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
                <input type="text" name="subtitle" value="{{ old('subtitle') }}" maxlength="255" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Button Text</label>
                    <input type="text" name="button_text" value="{{ old('button_text', 'Get Best Quotes') }}" maxlength="100" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Button URL</label>
                    <input type="text" name="button_url" value="{{ old('button_url') }}" maxlength="500" class="w-full rounded-lg border-gray-300 border px-3 py-2 text-sm">
                </div>
            </div>

            <label class="flex items-center gap-2 text-sm text-gray-600">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                Active (shown on the homepage)
            </label>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-5 py-2.5 rounded-lg">Save Card</button>
                <a href="{{ route('admin.home.index') }}" class="text-sm px-5 py-2.5 rounded-lg border text-gray-600 hover:bg-gray-50">Cancel</a>
            </div>
        </form>
    </div>
@endsection
