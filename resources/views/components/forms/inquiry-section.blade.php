<section id="inquiry" class="min-h-screen bg-[#f8f9fa] py-20 px-6 lg:px-24 flex items-center relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-[#7f03d3]/5 rounded-full blur-3xl -mr-20 -mt-20"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-[#145589]/5 rounded-full blur-3xl -ml-20 -mb-20"></div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center relative z-10">

        <div class="space-y-10">
            <div>
                <span
                    class="inline-block px-4 py-1 rounded-full bg-[#145589]/10 text-[#145589] font-bold tracking-widest uppercase text-xs">
                    Let's Solve Your Samsya
                </span>
                <h1 class="text-5xl lg:text-7xl font-black text-[#145589] mt-6 leading-tight tracking-tighter">
                    Build the <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-[#7f03d3] to-[#fd7319]">Unbuildable.</span>
                </h1>
                <p class="text-xl text-slate-600 mt-8 max-w-lg leading-relaxed">
                    Stop fighting technical debt. From high-performance **Flutter apps** to robust **Laravel
                    ecosystems**, we engineer the backbone of your digital success.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div class="flex items-start space-x-4">
                    <div class="p-3 bg-white shadow-md rounded-2xl text-[#fd7319]">
                        <ion-icon name="shield-checkmark-outline" class="text-2xl"></ion-icon>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#145589]">Security First</h4>
                        <p class="text-xs text-slate-500 uppercase tracking-wider">Zero-vulnerability Code</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4">
                    <div class="p-3 bg-white shadow-md rounded-2xl text-[#7f03d3]">
                        <ion-icon name="flash-outline" class="text-2xl"></ion-icon>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#145589]">Rapid Sprints</h4>
                        <p class="text-xs text-slate-500 uppercase tracking-wider">2-Week Delivery Cycles</p>
                    </div>
                </div>
            </div>


            <img src="/assets/images/client-application.jpg" class="rounded-lg" />

        </div>

        <div class="relative">
            <div
                class="absolute -top-10 -right-10 w-64 h-64 bg-[#7f03d3]/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse">
            </div>
            <div
                class="absolute -bottom-10 -left-10 w-64 h-64 bg-[#fd7319]/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-pulse transition-delay-2000">
            </div>

            <div
                class="relative bg-white/90 backdrop-blur-2xl p-8 md:p-12 rounded-[2rem] shadow-[0_20px_50px_rgba(20,85,137,0.15)] border border-white/40">
                <h3 class="text-3xl font-black text-[#145589] mb-3 leading-none">Start Your Project</h3>
                <p class="text-slate-500 mb-10 text-sm font-medium">Briefly explain your vision, and our lead engineer
                    will contact you.</p>

                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-[#145589] mb-2 ml-1">Full
                            Name</label>
                        <input type="text" placeholder="Ashish Kumar"
                            class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-white/50 focus:bg-white focus:ring-2 focus:ring-[#7f03d3] focus:border-transparent outline-none transition-all shadow-sm"
                            required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label
                                class="block text-xs font-black uppercase tracking-widest text-[#145589] mb-2 ml-1">Work
                                Email</label>
                            <input type="email" placeholder="ashish@mdbusiness.com"
                                class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-white/50 focus:bg-white focus:ring-2 focus:ring-[#7f03d3] focus:border-transparent outline-none transition-all shadow-sm"
                                required>
                        </div>
                        <div>
                            <label
                                class="block text-xs font-black uppercase tracking-widest text-[#145589] mb-2 ml-1">Mobile</label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-4 rounded-l-2xl border border-r-0 border-slate-100 bg-slate-50 text-slate-500 font-bold text-sm">+91</span>
                                <input type="tel" placeholder="000 000 0000"
                                    class="w-full px-5 py-4 rounded-r-2xl border border-slate-100 bg-white/50 focus:bg-white focus:ring-2 focus:ring-[#7f03d3] focus:border-transparent outline-none transition-all shadow-sm"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label
                            class="block text-xs font-black uppercase tracking-widest text-[#145589] mb-2 ml-1">Service
                            Required</label>
                        <div class="relative">
                            <select
                                class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-white/50 focus:bg-white focus:ring-2 focus:ring-[#7f03d3] focus:border-transparent outline-none transition-all shadow-sm appearance-none cursor-pointer font-medium text-slate-700"
                                required>
                                <option value="" disabled selected>Select a solution</option>
                                <option value="flutter">Flutter Mobile App Development</option>
                                <option value="laravel">Laravel Web Ecosystems</option>
                                <option value="ai">AI & Automation Strategy</option>
                                <option value="proptech">PropTech Solutions</option>
                                <option value="ecommerce">E-commerce Transformation</option>
                            </select>
                            <ion-icon name="chevron-down-outline"
                                class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none"></ion-icon>
                        </div>
                    </div>

                    <div>
                        <label
                            class="block text-xs font-black uppercase tracking-widest text-[#145589] mb-2 ml-1">Project
                            Brief</label>
                        <textarea rows="4" placeholder="Describe your digital challenge..."
                            class="w-full px-5 py-4 rounded-2xl border border-slate-100 bg-white/50 focus:bg-white focus:ring-2 focus:ring-[#7f03d3] focus:border-transparent outline-none transition-all shadow-sm"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#fd7319] hover:bg-[#e66716] text-white font-black py-5 rounded-2xl shadow-xl shadow-orange-200 transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-widest">
                        Initialize Transformation
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>
