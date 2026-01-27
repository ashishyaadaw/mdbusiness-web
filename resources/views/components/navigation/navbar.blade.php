<nav id="navbar"
    class="fixed top-0 left-0 w-full z-50 bg-white transition-all duration-300 ease-in-out border-b border-gray-100 px-4 py-3">

    <div id="top-row"
        class="flex items-center justify-between mb-3 transition-all duration-300 overflow-hidden max-h-20 opacity-100">
        <div class="flex items-center">
            <h1 class="text-2xl font-bold tracking-tight">
                <span class="text-blue-600">Just</span><span class="text-orange-500">dial</span>
            </h1>
        </div>

        <div class="flex items-center space-x-4">
            <button
                class="hidden md:flex items-center text-blue-600 border border-blue-200 px-3 py-1 rounded-md text-sm font-semibold hover:bg-blue-50">
                <i data-lucide="megaphone" class="w-4 h-4 mr-2"></i>
                Advertise
            </button>
            <button class="text-gray-600"><i data-lucide="bell" class="w-6 h-6"></i></button>
            <button class="text-gray-400"><i data-lucide="user-circle-2" class="w-8 h-8"></i></button>
        </div>
    </div>

    <div class="relative max-w-4xl mx-auto">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i data-lucide="search" class="h-5 w-5 text-gray-800 font-bold"></i>
        </div>
        <input type="text" placeholder="Spas & Salons"
            class="block w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-xl bg-white text-gray-900 focus:outline-none focus:ring-1 focus:ring-blue-500 shadow-sm text-lg font-medium">
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
            <i data-lucide="mic" class="h-6 w-6 text-blue-500"></i>
        </div>
    </div>
</nav>

<div class="h-40"></div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>

@push('script')
    <script>
        window.onscroll = function() {
            const navbar = document.getElementById("navbar");
            const topRow = document.getElementById("top-row");

            if (document.body.scrollTop > 40 || document.documentElement.scrollTop > 40) {
                // SCROLLED STATE
                topRow.style.maxHeight = "0px";
                topRow.style.opacity = "0";
                topRow.style.marginBottom = "0px";
                navbar.classList.add("shadow-md", "py-2");
                navbar.classList.remove("py-3");
            } else {
                // INITIAL STATE
                topRow.style.maxHeight = "80px";
                topRow.style.opacity = "100";
                topRow.style.marginBottom = "12px";
                navbar.classList.remove("shadow-md", "py-2");
                navbar.classList.add("py-3");
            }
        };
    </script>
@endpush
