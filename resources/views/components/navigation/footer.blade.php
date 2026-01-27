<footer class="bg-[#040712] text-gray-400 pt-20 pb-10 border-t border-white/5 relative overflow-hidden">
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#145589]/5 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-16 text-left">

            <div class="col-span-1">
                <a href="{{ url('/') }}" class="inline-block mb-8 transition-transform hover:scale-105">
                    <img src="/assets/icon/websamsya.png" class="h-14 w-auto object-contain brightness-110"
                        alt="Websamsya" />
                </a>
                <p class="text-sm leading-relaxed mb-8 max-w-xs font-medium">
                    A premium digital unit of <strong>One Advertisers</strong>. We architect scalable code and
                    high-impact advertising to solve your complex "Samsyas."
                </p>
                <div class="flex space-x-5">
                    <a href="#"
                        class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center hover:bg-[#145589] hover:text-white transition-all group">
                        <ion-icon name="logo-facebook" class="text-xl"></ion-icon>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center hover:bg-[#7f03d3] hover:text-white transition-all group">
                        <ion-icon name="logo-instagram" class="text-xl"></ion-icon>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center hover:bg-[#fd7319] hover:text-white transition-all group">
                        <ion-icon name="logo-linkedin" class="text-xl"></ion-icon>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center hover:bg-white hover:text-black transition-all group">
                        <ion-icon name="logo-x" class="text-xl"></ion-icon>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-white font-black uppercase tracking-widest text-xs mb-8">Core Solutions</h4>
                <ul class="space-y-4 text-sm font-medium">
                    <li><a href="{{ route('services.app-dev') }}"
                            class="hover:text-[#fd7319] transition-colors flex items-center gap-2"><span
                                class="w-1.5 h-1.5 bg-[#fd7319] rounded-full"></span> Flutter App Development</a></li>
                    <li><a href="{{ route('services.web-dev') }}"
                            class="hover:text-[#fd7319] transition-colors flex items-center gap-2"><span
                                class="w-1.5 h-1.5 bg-[#fd7319] rounded-full"></span> Laravel Web Engines</a></li>
                    <li><a href="{{ route('solutions.ai') }}"
                            class="hover:text-[#fd7319] transition-colors flex items-center gap-2"><span
                                class="w-1.5 h-1.5 bg-[#fd7319] rounded-full"></span> Custom AI & ML</a></li>
                    <li><a href="{{ route('solutions.automation') }}"
                            class="hover:text-[#fd7319] transition-colors flex items-center gap-2"><span
                                class="w-1.5 h-1.5 bg-[#fd7319] rounded-full"></span> Process Automation</a></li>
                    <li><a href="{{ route('services.ui-ux') }}"
                            class="hover:text-[#fd7319] transition-colors flex items-center gap-2"><span
                                class="w-1.5 h-1.5 bg-[#fd7319] rounded-full"></span> UI/UX Conversion Design</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-black uppercase tracking-widest text-xs mb-8">Governance</h4>
                <ul class="space-y-4 text-sm font-medium">
                    <li><a href="{{ route('privacy') }}" class="hover:text-white transition-colors">Privacy & Data
                            Policy</a></li>
                    <li><a href="{{ route('terms') }}" class="hover:text-white transition-colors">Terms of Service</a>
                    </li>
                    <li><a href="{{ route('refund') }}" class="hover:text-white transition-colors">Refund &
                            Cancellation</a></li>
                    <li><a href="{{ route('shipping') }}" class="hover:text-white transition-colors">Advertising
                            Delivery</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-black uppercase tracking-widest text-xs mb-8">Reach the Lab</h4>
                <ul class="space-y-5 text-sm font-medium">
                    <li class="flex items-start gap-4">
                        <ion-icon name="location-outline" class="text-xl text-[#fd7319]"></ion-icon>
                        <span class="leading-relaxed">Deoria, Uttar Pradesh,<br>India - 274001</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <ion-icon name="mail-unread-outline" class="text-xl text-[#fd7319]"></ion-icon>
                        <a href="mailto:info@websamsya.com"
                            class="hover:text-white transition-colors">info@websamsya.com</a>
                    </li>
                    <li class="flex items-center gap-4">
                        <ion-icon name="logo-whatsapp" class="text-xl text-green-500"></ion-icon>
                        <a href="https://wa.me/910000000000" class="hover:text-white transition-colors">+91 00000
                            00000</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-600 text-left">
                © {{ date('Y') }} Websamsya Software Solutions • Precision Engineered in India
            </div>

            <div
                class="flex items-center gap-2 opacity-40 hover:opacity-100 transition-opacity grayscale hover:grayscale-0">
                <span class="text-[10px] font-bold uppercase tracking-widest text-gray-500">Powerhouse:</span>
                <img src="/assets/icon/oneadvertisers-logo.png" class="h-6 w-auto" alt="One Advertisers" />
            </div>
        </div>
    </div>
</footer>
