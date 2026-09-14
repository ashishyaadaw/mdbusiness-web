@extends('layouts.app', ['title' => $matter->title, 'isSearchBar' => false])

@section('content')
    @php
        $cityMenu = $matter->cityMenuMatter->first()?->cityMenu;
        $details = $matter->matterDetails;
        $status = $matter->matterController?->status;
    @endphp

    <div class="py-6 max-w-3xl mx-auto">
        @if ($isOwner && $status !== 'active')
            <div class="mb-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3 text-sm">
                This is a preview of your listing. Current status: <strong>{{ ucfirst($status ?? 'pending') }}</strong>
                — it's only visible to the public once an admin approves it.
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            @if ($matter->type === 'image' && count($matter->image_urls))
                @if (count($matter->image_urls) > 1)
                    <div id="matter-gallery-{{ $matter->id }}" class="splide bg-gray-100" aria-label="{{ $matter->title }} images">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($matter->image_urls as $url)
                                    <li class="splide__slide">
                                        <img src="{{ $url }}" alt="{{ $matter->title }}" class="w-full h-auto block">
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="splide__arrows"></div>
                        <div class="splide__pagination"></div>
                    </div>

                    @push('script')
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                if (typeof Splide !== 'undefined') {
                                    new Splide('#matter-gallery-{{ $matter->id }}', {
                                        type: 'loop',
                                        perPage: 1,
                                        autoHeight: true,
                                        gap: 0,
                                        arrows: true,
                                        pagination: true,
                                    }).mount();
                                }
                            });
                        </script>
                    @endpush
                @else
                    <img src="{{ $matter->image_urls[0] }}" alt="{{ $matter->title }}" class="w-full h-auto block bg-gray-100">
                @endif
            @endif

            <div class="p-6">
                <div class="flex items-start justify-between gap-3">
                    <h1 class="text-2xl font-bold text-gray-900">{{ $matter->title }}</h1>
                    @if ($matter->matterController?->is_premium)
                        <span class="shrink-0 text-[10px] font-black uppercase tracking-wide text-white bg-[#fd7319] px-2 py-1 rounded-full">Premium</span>
                    @endif
                </div>

                @if ($cityMenu)
                    <p class="text-sm text-gray-500 mt-1">{{ $cityMenu->menu?->title }} &middot; {{ $cityMenu->city?->name }}</p>
                @endif

                @if ($matter->type === 'text')
                    <p class="text-gray-700 mt-4 whitespace-pre-line">{{ $matter->payload }}</p>
                @endif

                @if ($details)
                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        @if ($details->name)
                            <div><span class="text-gray-400">Contact</span><br><span class="font-semibold text-gray-800">{{ $details->name }}</span></div>
                        @endif
                        @if ($details->phone)
                            <div><span class="text-gray-400">Phone</span><br><a href="tel:{{ $details->phone }}" class="font-semibold text-blue-600">{{ $details->phone }}</a></div>
                        @endif
                        @if ($details->whatsapp)
                            <div><span class="text-gray-400">WhatsApp</span><br><a href="https://wa.me/{{ $details->whatsapp }}" target="_blank" class="font-semibold text-green-600">{{ $details->whatsapp }}</a></div>
                        @endif
                        @if ($details->alternate_contact)
                            <div><span class="text-gray-400">Alternate Contact</span><br><span class="font-semibold text-gray-800">{{ $details->alternate_contact }}</span></div>
                        @endif
                        @if ($details->website)
                            <div><span class="text-gray-400">Website</span><br><a href="{{ $details->website }}" target="_blank" class="font-semibold text-blue-600 break-all">{{ $details->website }}</a></div>
                        @endif
                        @if ($details->social_media)
                            <div><span class="text-gray-400">Social Media</span><br><a href="{{ $details->social_media }}" target="_blank" class="font-semibold text-blue-600 break-all">{{ $details->social_media }}</a></div>
                        @endif
                        @if ($details->gstin)
                            <div><span class="text-gray-400">GSTIN</span><br><span class="font-semibold text-gray-800">{{ $details->gstin }}</span></div>
                        @endif
                    </div>

                    @if ($details->tags)
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach (array_filter(array_map('trim', explode(',', $details->tags))) as $tag)
                                <span class="text-xs bg-gray-100 text-gray-600 px-3 py-1 rounded-full">#{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
