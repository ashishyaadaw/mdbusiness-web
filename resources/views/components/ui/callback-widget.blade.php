<div class="fixed bottom-8 left-8 z-50 flex flex-col items-start">
    <div id="callbackFormContainer"
        class="hidden mb-4 w-80 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden transition-all duration-300 transform scale-95 opacity-0 origin-bottom-left">

        <div class="bg-gradient-to-r from-[#145589] to-[#7f03d3] p-5 text-white flex justify-between items-center">
            <div>
                <h3 class="font-bold text-lg">Let's Talk Tech</h3>
                <p class="text-xs opacity-80">We'll call you back shortly.</p>
            </div>
            <button id="closeCallback" class="hover:bg-white/20 rounded-full p-1 transition-colors">
                <ion-icon name="close-outline" class="text-2xl"></ion-icon>
            </button>
        </div>

        <form id="callbackSubmitForm" class="p-5 space-y-4">
            @csrf
            <div>
                <label class="text-[10px] uppercase tracking-wider text-gray-500 font-bold ml-1">Full Name</label>
                <input type="text" name="name" placeholder="Dr. Ashish" required
                    class="w-full px-3 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#7f03d3] focus:border-transparent outline-none text-sm transition-all">
            </div>

            <div>
                <label class="text-[10px] uppercase tracking-wider text-gray-500 font-bold ml-1">Phone Number</label>
                <input type="tel" name="phone" placeholder="+91 000 000 0000" required
                    class="w-full px-3 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#7f03d3] focus:border-transparent outline-none text-sm transition-all">
            </div>

            <div>
                <label class="text-[10px] uppercase tracking-wider text-gray-500 font-bold ml-1">Interested In</label>
                <select name="service" required
                    class="w-full px-3 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#7f03d3] outline-none text-sm text-gray-600 appearance-none">
                    <option value="" disabled selected>Select a Service</option>
                    <option value="web-dev">Web Development</option>
                    <option value="app-dev">Mobile Apps</option>
                    <option value="automation">AI & Automation</option>
                    <option value="uiux">UI/UX Design</option>
                </select>
            </div>

            <div>
                <label class="text-[10px] uppercase tracking-wider text-gray-500 font-bold ml-1">Preferred Time</label>
                <select name="time"
                    class="w-full px-3 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#7f03d3] outline-none text-sm text-gray-600">
                    <option value="asap">Call me ASAP</option>
                    <option value="morning">Morning (9AM - 12PM)</option>
                    <option value="afternoon">Afternoon (12PM - 5PM)</option>
                </select>
            </div>

            <button type="submit"
                class="w-full bg-[#fd7319] text-white py-3 rounded-xl font-bold text-sm hover:bg-[#e66716] shadow-lg shadow-orange-200 transition-all active:scale-95">
                Request Call Back
            </button>
        </form>

        <div id="callbackSuccess" class="hidden p-8 text-center">
            <div
                class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <ion-icon name="checkmark-done-outline" class="text-3xl"></ion-icon>
            </div>
            <h4 class="font-bold text-gray-800">Request Sent!</h4>
            <p class="text-sm text-gray-500 mt-2">Our experts will reach out to you within the requested time.</p>
        </div>
    </div>

    <button id="callbackToggle"
        class="group flex items-center gap-3 bg-[#7f03d3] text-white p-4 rounded-full shadow-2xl hover:shadow-purple-300 transition-all duration-300 hover:pr-8 active:scale-90">
        <div class="bg-white/20 p-1.5 rounded-full group-hover:rotate-12 transition-transform">
            <ion-icon name="call-outline" class="text-2xl block"></ion-icon>
        </div>
        <span
            class="max-w-0 overflow-hidden whitespace-nowrap font-bold group-hover:max-w-xs transition-all duration-500 ease-in-out">
            Request Call
        </span>
    </button>
</div>

@push('script')
    <script>
        $(document).ready(function() {
            const $container = $('#callbackFormContainer');
            const $toggle = $('#callbackToggle');

            // Toggle Expand/Collapse
            $toggle.on('click', function() {
                if ($container.hasClass('hidden')) {
                    $container.removeClass('hidden');
                    setTimeout(() => {
                        $container.removeClass('scale-95 opacity-0').addClass(
                            'scale-100 opacity-100');
                    }, 10);
                    $(this).addClass('scale-0 opacity-0');
                }
            });

            $('#closeCallback').on('click', function() {
                $container.removeClass('scale-100 opacity-100').addClass('scale-95 opacity-0');
                setTimeout(() => {
                    $container.addClass('hidden');
                    $toggle.removeClass('scale-0 opacity-0');
                }, 300);
            });

            // Form Submission
            $('#callbackSubmitForm').on('submit', function(e) {
                e.preventDefault();
                const $form = $(this);
                const $btn = $form.find('button');

                $btn.prop('disabled', true).text('Sending...');

                // Mock AJAX call - Replace with your real route
                // Inside the form submission logic
                $.ajax({
                    url: "/api/callback-request",
                    method: "POST",
                    data: {
                        phone: $form.find('input[name="phone"]').val(),
                        time: $form.find('select[name="time"]').val(),
                        _token: "{{ csrf_token() }}" // Laravel CSRF Protection
                    },
                    success: function(response) {
                        if (response.success) {
                            $form.fadeOut(300, function() {
                                $('#callbackSuccess').fadeIn();
                                setTimeout(() => $('#closeCallback').click(), 3000);
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMsg = xhr.responseJSON.errors?.phone?.[0] ||
                            "Something went wrong.";
                        alert(errorMsg);
                        $btn.prop('disabled', false).text('Submit Request');
                    }
                });
            });
        });
    </script>
@endpush
