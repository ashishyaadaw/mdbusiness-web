@extends('admin.layout')

@section('title', 'Homepage Content')

@section('content')
    <div class="mb-8">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-lg font-semibold">Hero Slider</h2>
            <a href="{{ route('admin.home.slides.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg">
                + Add Slide
            </a>
        </div>
        <p class="text-sm text-gray-500 mb-3">Slides shown, in order, at the top of the homepage. Each slide has its own image, heading, subtext and call-to-action button.</p>

        <div class="bg-white rounded-xl border overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-left">
                    <tr>
                        <th class="px-4 py-3">Order</th>
                        <th class="px-4 py-3">Image</th>
                        <th class="px-4 py-3">Heading</th>
                        <th class="px-4 py-3">CTA</th>
                        <th class="px-4 py-3">Active</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($slides as $slide)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-0.5">
                                    @foreach (['top' => '⤒', 'up' => '▲', 'down' => '▼', 'bottom' => '⤓'] as $direction => $icon)
                                        <form method="POST" action="{{ route('admin.home.slides.reorder', $slide) }}">
                                            @csrf
                                            <input type="hidden" name="direction" value="{{ $direction }}">
                                            <button type="submit" title="Move {{ $direction }}"
                                                    class="w-6 h-6 flex items-center justify-center rounded border text-gray-500 hover:bg-gray-100 hover:text-gray-800 text-xs">
                                                {{ $icon }}
                                            </button>
                                        </form>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <img src="{{ $slide->image_url }}" alt="{{ $slide->heading }}" class="h-12 w-20 rounded object-cover border">
                            </td>
                            <td class="px-4 py-3">
                                <div class="font-medium">{{ $slide->heading ?: '—' }}</div>
                                <div class="text-xs text-gray-500">{{ $slide->subheading }}</div>
                            </td>
                            <td class="px-4 py-3 text-gray-500">{{ $slide->button_text ?: '—' }}</td>
                            <td class="px-4 py-3">
                                <span class="text-xs px-2 py-1 rounded-full {{ $slide->is_active ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $slide->is_active ? 'Active' : 'Hidden' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex gap-1.5 justify-end">
                                    <a href="{{ route('admin.home.slides.edit', $slide) }}" class="text-xs px-2 py-1 rounded bg-indigo-50 text-indigo-700 hover:bg-indigo-100">Edit</a>
                                    <form method="POST" action="{{ route('admin.home.slides.destroy', $slide) }}" onsubmit="return confirm('Delete this slide?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-xs px-2 py-1 rounded bg-red-50 text-red-700 hover:bg-red-100">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-6 text-center text-gray-500">No slides yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div>
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-lg font-semibold">Service Cards <span class="text-sm font-normal text-gray-400">(e.g. "Looking for? Interior Design")</span></h2>
            <a href="{{ route('admin.home.cards.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg">
                + Add Card
            </a>
        </div>
        <p class="text-sm text-gray-500 mb-3">Small promo cards shown next to the hero slider on the homepage.</p>

        <div class="bg-white rounded-xl border overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-left">
                    <tr>
                        <th class="px-4 py-3">Order</th>
                        <th class="px-4 py-3">Image</th>
                        <th class="px-4 py-3">Eyebrow / Title</th>
                        <th class="px-4 py-3">Button</th>
                        <th class="px-4 py-3">Active</th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse ($cards as $card)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-0.5">
                                    @foreach (['top' => '⤒', 'up' => '▲', 'down' => '▼', 'bottom' => '⤓'] as $direction => $icon)
                                        <form method="POST" action="{{ route('admin.home.cards.reorder', $card) }}">
                                            @csrf
                                            <input type="hidden" name="direction" value="{{ $direction }}">
                                            <button type="submit" title="Move {{ $direction }}"
                                                    class="w-6 h-6 flex items-center justify-center rounded border text-gray-500 hover:bg-gray-100 hover:text-gray-800 text-xs">
                                                {{ $icon }}
                                            </button>
                                        </form>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                @if ($card->image_url)
                                    <img src="{{ $card->image_url }}" alt="{{ $card->title }}" class="h-12 w-12 rounded object-cover border">
                                @else
                                    <span class="h-12 w-12 rounded border {{ $card->bg_class ?: 'bg-slate-900' }} flex items-center justify-center text-white text-[10px]">no img</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-xs text-gray-500">{{ $card->eyebrow }}</div>
                                <div class="font-medium">{{ $card->title ?: '—' }}</div>
                            </td>
                            <td class="px-4 py-3 text-gray-500">{{ $card->button_text ?: '—' }}</td>
                            <td class="px-4 py-3">
                                <span class="text-xs px-2 py-1 rounded-full {{ $card->is_active ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $card->is_active ? 'Active' : 'Hidden' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex gap-1.5 justify-end">
                                    <a href="{{ route('admin.home.cards.edit', $card) }}" class="text-xs px-2 py-1 rounded bg-indigo-50 text-indigo-700 hover:bg-indigo-100">Edit</a>
                                    <form method="POST" action="{{ route('admin.home.cards.destroy', $card) }}" onsubmit="return confirm('Delete this card?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-xs px-2 py-1 rounded bg-red-50 text-red-700 hover:bg-red-100">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-6 text-center text-gray-500">No cards yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
