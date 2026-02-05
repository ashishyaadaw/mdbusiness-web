<div class="flex w-full max-w-7xl mx-auto flex gap-3 py-4 bg-white overflow-hidden">

    <div
        class="flex-1 min-w-[300px] h-64 bg-gradient-to-br from-slate-50 to-blue-50 rounded-3xl relative overflow-hidden flex items-center p-8 border border-blue-100/50 shadow-sm group">
        <div class="z-10 max-w-[60%]">
            <span class="text-blue-600 font-bold text-xs uppercase tracking-wider">Mobile Experience</span>
            <h2 class="text-3xl font-extrabold text-slate-800 leading-tight mt-1">
                Download our <br> <span class="text-blue-600">Mobile App</span>
            </h2>
            <p class="text-slate-500 text-sm mt-2 mb-6">Get the best job alerts and business services on the go.</p>

            <a href="#" class="inline-block transition-transform hover:scale-105 active:scale-95">
                <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                    alt="Get it on Google Play" class="h-10 md:h-12">
            </a>
        </div>

        <div
            class="absolute -right-4 top-4 h-[120%] w-1/2 rotate-12 opacity-20 md:opacity-100 transition-all group-hover:rotate-6">
            <img src="/assets/images/smartphone.png" alt="App Mockup" class="h-full object-contain drop-shadow-2xl">
        </div>

        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-blue-200/20 rounded-full blur-3xl"></div>
    </div>

    <div
        class="hidden sm:flex w-40 h-64 bg-slate-900 rounded-2xl shrink-0 p-4 flex-col group cursor-pointer transition-all duration-300 justify-end text-white">
        <p class="text-sm">Looking for?</p>
        <h3 class="font-bold transition-all duration-300 group-hover:text-xl">Interior Design</h3>
        <button class="mt-2 bg-yellow-500 hover:bg-yellow-400 text-black text-[10px] font-bold py-1 px-2 rounded">Get
            Best Quotes</button>
    </div>

    <div
        class="hidden md:flex w-32 h-64 bg-blue-600 rounded-2xl shrink-0 p-4 flex-col text-white relative group cursor-pointer transition-all duration-300">
        <h3 class="font-bold transition-all duration-300 group-hover:text-2xl">B2B</h3>
        <p class="text-[10px] opacity-80">Quick Quotes</p>

        <div class="mt-auto self-start text-xl font-bold transition-all duration-300 flex items-center gap-1">
            <a href="{{ route('services.show', ['category' => 'b2b']) }}">
                <span
                    class="max-w-0 overflow-hidden opacity-0 group-hover:max-w-[100px] group-hover:opacity-100 transition-all duration-500 text-sm uppercase tracking-wider">Explore</span>
                <span>›</span>
            </a>
        </div>
    </div>

    <div
        class="hidden md:flex w-32 h-64 bg-blue-600 rounded-2xl shrink-0 p-4 flex-col text-white relative group cursor-pointer transition-all duration-300">
        <h3 class="font-bold transition-all duration-300 group-hover:text-xl">REPAIRS & SERVICES</h3>
        <p class="text-[10px] opacity-80">Get Nearest Vendor</p>

        <div class="mt-auto self-start text-xl font-bold transition-all duration-300 flex items-center gap-1">
            <a href="{{ route('services.show', ['category' => 'repair']) }}">
                <span
                    class="max-w-0 overflow-hidden opacity-0 group-hover:max-w-[100px] group-hover:opacity-100 transition-all duration-500 text-sm uppercase tracking-wider">Explore</span>
                <span>›</span>
            </a>
        </div>
    </div>

    <div
        class="hidden md:flex w-32 h-64 bg-blue-600 rounded-2xl shrink-0 p-4 flex-col text-white relative group cursor-pointer transition-all duration-300">
        <h3 class="font-bold transition-all duration-300 group-hover:text-xl">REAL ESTATE</h3>
        <p class="text-[10px] opacity-80">Finest Agents</p>

        <div class="mt-auto self-start text-xl font-bold transition-all duration-300 flex items-center gap-1">
            <a href="{{ route('services.show', ['category' => 'real-estate']) }}">
                <span
                    class="max-w-0 overflow-hidden opacity-0 group-hover:max-w-[100px] group-hover:opacity-100 transition-all duration-500 text-sm uppercase tracking-wider">Explore</span>
                <span>›</span>
            </a>
        </div>
    </div>





</div>
