<section class="bg-gray-50 py-24 px-6 overflow-hidden">
    <div
        class="max-w-5xl mx-auto bg-white rounded-[2.5rem] shadow-[0_20px_60px_rgba(20,85,137,0.12)] overflow-hidden flex flex-col md:flex-row border border-gray-50">

        <div
            class="bg-gradient-to-br from-[#145589] via-[#145589] to-[#7f03d3] p-10 md:p-14 md:w-5/12 text-white flex flex-col justify-center relative">
            <div class="absolute top-10 right-10 opacity-10">
                <ion-icon name="calculator-outline" class="text-9xl"></ion-icon>
            </div>

            <div class="relative z-10">
                <div class="inline-block p-3 bg-white/10 backdrop-blur-md rounded-2xl mb-6">
                    <ion-icon name="document-attach-outline" class="text-4xl text-[#fd7319]"></ion-icon>
                </div>
                <h2 class="text-4xl font-black mb-6 leading-tight tracking-tighter">Budgeting Your <br><span
                        class="text-orange-400">Next Big Idea.</span></h2>
                <p class="text-blue-100 mb-8 font-medium leading-relaxed">
                    Planning a "Samsya" free launch? Download our 2026 Tech-Stack & Project Pricing Guide.
                </p>
                <ul class="space-y-4 text-sm font-semibold">
                    <li class="flex items-center gap-3"><ion-icon name="shield-checkmark"
                            class="text-[#fd7319] text-xl"></ion-icon> MVP vs Enterprise Timelines</li>
                    <li class="flex items-center gap-3"><ion-icon name="shield-checkmark"
                            class="text-[#fd7319] text-xl"></ion-icon> Flutter vs Native Costing</li>
                    <li class="flex items-center gap-3"><ion-icon name="shield-checkmark"
                            class="text-[#fd7319] text-xl"></ion-icon> Yearly Maintenance Ratios</li>
                </ul>
            </div>
        </div>

        <div class="p-10 md:p-14 md:w-7/12 flex flex-col justify-center bg-white">
            <form id="downloadEstimateForm" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2 ml-1">Your
                            Name</label>
                        <input type="text" name="name" required placeholder="John Doe"
                            class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-[#7f03d3] focus:bg-white outline-none transition-all shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2 ml-1">Work
                            Email</label>
                        <input type="email" name="email" required placeholder="john@mdbusiness.com"
                            class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-[#7f03d3] focus:bg-white outline-none transition-all shadow-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-2 ml-1">Project
                        Category</label>
                    <select name="category" required
                        class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-[#7f03d3] focus:bg-white outline-none transition-all shadow-sm font-medium text-gray-600 appearance-none">
                        <option value="startup">Startup MVP</option>
                        <option value="enterprise">Enterprise Software</option>
                        <option value="mobile">Mobile App (Flutter)</option>
                        <option value="ecommerce">E-commerce Solution</option>
                    </select>
                </div>

                <button type="submit" id="downloadBtn"
                    class="w-full bg-[#fd7319] text-white py-4 rounded-2xl font-black uppercase tracking-widest text-sm hover:bg-[#e66716] shadow-xl shadow-orange-100 transform active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                    <ion-icon name="cloud-download-outline" class="text-xl"></ion-icon>
                    <span>Send Me the 2026 Guide</span>
                </button>
                <p class="text-center text-[10px] text-gray-400 font-bold uppercase tracking-wider">🔒 No spam. Just
                    technical insights.</p>
            </form>

            <div id="downloadSuccess" class="hidden text-center py-8">
                <div
                    class="w-20 h-20 bg-green-50 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <ion-icon name="checkmark-done" class="text-5xl"></ion-icon>
                </div>
                <h4 class="text-2xl font-black text-[#145589] tracking-tighter">Guide Inbound!</h4>
                <p class="text-gray-500 mt-2 font-medium">Your PDF download has started automatically.</p>
            </div>
        </div>
    </div>
</section>
@push('script')
    <script>
        $('#downloadEstimateForm').on('submit', function(e) {
            e.preventDefault();
            const $form = $(this);
            const $btn = $('#downloadBtn');

            $btn.prop('disabled', true).find('span').text('Preparing PDF...');

            $.ajax({
                url: "/",
                method: "POST",
                data: $form.serialize(),
                success: function(response) {
                    // 1. Hide form, show success
                    $form.fadeOut(300, function() {
                        $('#downloadSuccess').fadeIn();
                    });

                    // 2. Trigger the actual file download
                    window.location.href = "/files/web-dev-estimate-2026.pdf";
                },
                error: function() {
                    alert('Something went wrong. Please try again.');
                    $btn.prop('disabled', false).find('span').text('Download PDF Estimate');
                }
            });
        });
    </script>
@endpush
