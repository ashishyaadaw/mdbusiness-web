<footer class="bg-[#f0f9ff] text-slate-600 pt-16 pb-10 border-t border-blue-100 relative overflow-hidden">
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-400/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute top-0 left-0 w-72 h-72 bg-rose-400/5 rounded-full blur-[80px] pointer-events-none"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div
            class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-16 gap-8 pb-12 border-b border-blue-200/50">
            <div class="max-w-md">
                <a href="{{ url('/') }}" class="inline-block mb-6 transition-transform hover:scale-105">
                    <img src="/assets/icon/mdbusiness.png" class="h-12 w-auto object-contain" alt="mdbusiness" />
                </a>
                <p class="text-sm leading-relaxed font-medium text-slate-500">
                    India's local search engine. Find <span class="text-blue-700 font-bold">Doctors, B2B, Real
                        Estate</span>, and <span class="text-blue-700 font-bold">100+ categories</span> in your city.
                </p>
            </div>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('advertise.business.listing') }}"
                    class="px-8 py-4 bg-[#fd7319] text-white rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-[#ff8533] transition-all shadow-lg shadow-[#fd7319]/30">
                    Free Listing / Add Business
                </a>
                <a href="{{ route('advertise.business.withus') }}"
                    class="px-8 py-4 bg-white text-blue-600 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-blue-50 transition-all border border-blue-200 shadow-sm">
                    Advertise with Us
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            <div>
                <h4 class="text-slate-900 font-black uppercase tracking-widest text-xs mb-8">Popular Categories</h4>
                <ul class="grid grid-cols-1 gap-4 text-sm font-semibold">
                    <li><a href="{{ route('services.show', ['category' => 'b2b']) }}"
                            class="hover:text-blue-600 transition-colors">B2B
                            Wholesalers</a></li>
                    <li><a href="{{ route('services.show', ['category' => 'doctors']) }}"
                            class="hover:text-blue-600 transition-colors">Doctors & Clinics</a></li>
                    <li><a href="{{ route('services.show', ['category' => 'resl-estate']) }}"
                            class="hover:text-blue-600 transition-colors">Real Estate Agents</a></li>
                    <li><a href="{{ route('services.show', ['category' => 'repair']) }}"
                            class="hover:text-blue-600 transition-colors">Home Repairs & Services</a>
                    </li>
                    <li><a href="{{ route('services.show', ['category' => 'wedding']) }}"
                            class="hover:text-blue-600 transition-colors">Wedding Photographers</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-slate-900 font-black uppercase tracking-widest text-xs mb-8">Top Cities</h4>
                <ul class="grid grid-cols-2 gap-4 text-sm font-semibold">
                    <li><a href="/city/delhi" class="hover:text-blue-600 transition-colors">Delhi</a></li>
                    <li><a href="/city/mumbai" class="hover:text-blue-600 transition-colors">Mumbai</a></li>
                    <li><a href="/city/bangalore" class="hover:text-blue-600 transition-colors">Bangalore</a></li>
                    <li><a href="/city/lucknow" class="hover:text-blue-600 transition-colors">Lucknow</a></li>
                    <li><a href="/city/gorakhpur" class="hover:text-blue-600 transition-colors">Gorakhpur</a></li>
                    <li><a href="/city/deoria" class="hover:text-blue-600 transition-colors">Deoria</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-slate-900 font-black uppercase tracking-widest text-xs mb-8">Resources</h4>
                <ul class="space-y-4 text-sm font-semibold">
                    <li><a href="{{ route('legal.privacy') }}" class="hover:text-blue-600 transition-colors">Privacy
                            Policy</a></li>
                    <li><a href="{{ route('legal.terms') }}" class="hover:text-blue-600 transition-colors">Terms of
                            Service</a></li>
                    <li><a href="/help" class="hover:text-blue-600 transition-colors">Customer Care</a></li>
                    <li><a href="/feedback" class="hover:text-blue-600 transition-colors">Submit Feedback</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-slate-900 font-black uppercase tracking-widest text-xs mb-8">Contact Support</h4>
                <ul class="space-y-5 text-sm font-semibold">
                    <li class="flex items-center gap-4">
                        <ion-icon name="call-outline" class="text-xl text-[#fd7319]"></ion-icon>
                        <a href="tel:+91859 107 2162  "
                            class="hover:text-blue-700 transition-colors text-lg font-bold text-slate-900">+91 859 107
                            2162</a>
                    </li>
                    <li class="flex items-center gap-4">
                        <ion-icon name="mail-unread-outline" class="text-xl text-[#fd7319]"></ion-icon>
                        <a href="mailto:support@mdbusiness.com"
                            class="hover:text-blue-600 transition-colors">support@mdbusiness.com</a>
                    </li>
                    <li class="flex space-x-4 pt-4">
                        <a href="#"
                            class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-[#1877f2] hover:text-white transition-all"><ion-icon
                                name="logo-facebook"></ion-icon></a>
                        <a href="#"
                            class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-[#e4405f] hover:text-white transition-all"><ion-icon
                                name="logo-instagram"></ion-icon></a>
                        <a href="https://wa.me/+918591072162?text=Hello!%20I%20am%20interested%20in%20your%20services."
                            target="_blank"
                            class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 hover:bg-slate-900 hover:text-white transition-all">
                            <ion-icon name="logo-whatsapp"></ion-icon>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="pt-8 border-t border-blue-200/50 flex flex-col md:flex-row justify-between items-center gap-6 text-center md:text-left">
            <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                © {{ date('Y') }} mdbusiness.com • Local Business Directory • Precision Engineered in India
            </div>

            <div class="flex items-center gap-4 opacity-60 hover:opacity-100 transition-opacity">
                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">A Venture Of:</span>
                <img src="/assets/icon/oneadvertisers.png" class="h-5 w-auto" alt="One Advertisers" />
            </div>
        </div>
    </div>
</footer>
