@php
    $states = ['Uttar Pradesh', 'Maharashtra', 'Delhi', 'Bihar', 'Rajasthan'];
    $cities = ['Gorakhpur', 'Lucknow', 'Kanpur', 'Varanasi', 'Agra', 'Noida'];
    // Default fallback values
    $defaultState = 'Uttar Pradesh';
    $defaultCity = 'Gorakhpur';
@endphp

<div class="w-full max-w-4xl mx-auto p-4" x-data="locationPicker()" x-init="initLocation()">

    <div class="relative flex items-center bg-white rounded-full shadow-lg border border-gray-100 overflow-visible">

        <div class="relative min-w-fit">
            <button @click="open = !open"
                class="flex items-center gap-2 px-5 py-3 bg-[#fd7319] text-white rounded-l-full hover:bg-rose-700 transition-colors focus:outline-none">
                <i data-lucide="target" class="w-5 h-5 cursor-pointer" @click.stop="fetchCurrentLocation()"></i>
                <span class="font-bold text-sm whitespace-nowrap" x-text="selectedState"></span>
                <i data-lucide="chevron-down" class="w-4 h-4 transition-transform"
                    :class="open ? 'rotate-180' : ''"></i>
            </button>

            <div x-show="open" @click.away="open = false" x-transition
                class="absolute left-0 mt-2 w-56 bg-[#fd7319] rounded-2xl shadow-xl z-50 py-2 border border-rose-500">
                @foreach ($states as $state)
                    <button @click="selectedState = '{{ $state }}'; open = false"
                        class="w-full text-left px-6 py-3 text-white font-semibold hover:bg-rose-700/50 transition-colors border-b border-rose-500/30 last:border-0">
                        {{ $state }}
                    </button>
                @endforeach
            </div>
        </div>

        <div class="flex-1 overflow-x-auto no-scrollbar flex items-center gap-1 px-4">
            @foreach ($cities as $city)
                <button @click="selectedCity = '{{ $city }}'"
                    class="px-5 py-2 whitespace-nowrap text-sm font-bold transition-all rounded-full"
                    :class="selectedCity === '{{ $city }}'
                        ?
                        'text-[#fd7319] bg-[#fd731950] relative after:absolute after:bottom-0 after:left-1/2 after:-translate-x-1/2 after:w-8 after:h-0.5 after:bg-[#fd7319]' :
                        'text-gray-400 hover:text-gray-600'">
                    {{ $city }}
                </button>
            @endforeach
        </div>

        <div class="pr-4 hidden md:block">
            <template x-if="loading">
                <div class="animate-spin rounded-full h-5 w-5 border-2 border-[#fd7319] border-t-transparent"></div>
            </template>
            <template x-if="!loading">
                <i data-lucide="search" class="w-5 h-5 text-gray-300"></i>
            </template>
        </div>
    </div>
</div>

<style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .no-scrollbar {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
    }
</style>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>

@push('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY"></script>

    <script>
        function locationPicker() {
            return {
                open: false,
                loading: false,
                selectedState: '{{ $defaultState }}',
                selectedCity: '{{ $defaultCity }}',

                initLocation() {
                    // Automatically fetch on load
                    this.fetchCurrentLocation();
                },

                fetchCurrentLocation() {
                    if (!navigator.geolocation) {
                        console.error("Geolocation is not supported by your browser");
                        return;
                    }

                    this.loading = true;

                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            const lat = position.coords.latitude;
                            const lng = position.coords.longitude;
                            this.reverseGeocode(lat, lng);
                        },
                        (error) => {
                            console.error("Location access denied or unavailable", error);
                            this.loading = false;
                        }
                    );
                },

                reverseGeocode(lat, lng) {
                    const geocoder = new google.maps.Geocoder();
                    const latlng = {
                        lat: parseFloat(lat),
                        lng: parseFloat(lng)
                    };

                    geocoder.geocode({
                        location: latlng
                    }, (results, status) => {
                        this.loading = false;
                        if (status === "OK" && results[0]) {
                            let city = "";
                            let state = "";

                            // Extract City and State from Google Address Components
                            results[0].address_components.forEach(component => {
                                if (component.types.includes("administrative_area_level_1")) {
                                    state = component.long_name;
                                }
                                if (component.types.includes("locality")) {
                                    city = component.long_name;
                                }
                            });

                            // Update UI if values were found
                            if (state) this.selectedState = state;
                            if (city) this.selectedCity = city;

                            console.log(`Detected: ${city}, ${state}`);
                        }
                    });
                }
            }
        }
    </script>
@endpush
